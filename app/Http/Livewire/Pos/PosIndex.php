<?php

namespace App\Http\Livewire\Pos;

use Exception;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PosIndex extends Component
{
    protected $products;
    public $transaction;
    public $amount_tendered = '';
    public $selected_product;
    public $discount = 5;
    public $selected_quantity = 1;
    public $selected_price = 0.00;
    public $query = '';
    public $perPage = 20;
    public $paymentModal = false;

    public function getListeners()
    {
        return [
            'loadMore',
        ];
    }

    protected $rules = [
        'amount_tendered' => "numeric|min:0"
    ];
    protected $messages = [
        'amount_tendered.numeric' => 'Please enter a valid amount.',
        'amount_tendered.min' => 'Please enter a value greater than 0.',
    ];

    public function loadMore()
    {
        if ($this->perPage < Product::count())
            $this->perPage += 10;
    }

    public function mount()
    {
        $this->transaction = Transaction::where('is_final', false)->with('products')->firstOrCreate();
    }

    public function render()
    {
        if ($this->query) {
            $this->products = Product::where('name', 'like', "%$this->query%")->withStocks()->with(['unit'])->take($this->perPage)->get();
        } else
            $this->products = Product::with(['unit'])->withStocks()->take($this->perPage)->get();
        return view('livewire.pos.pos-index', [
            'products' => $this->products,
        ])
            ->extends('layouts.master')
            ->section('content');
    }

    public function selectProduct(Product $product)
    {
        $this->selected_product = $product;
        $this->selected_quantity = 1;
        $this->selected_price = number_format($product->srp, 2, '.', '');
    }

    public function discardTransaction()
    {
        $this->transaction->delete();
        $this->sweetAlert('success', 'Transaction discarded.');
        $this->transaction = Transaction::where('is_final', false)->with('products')->firstOrCreate();
    }

    public function addToSale()
    {
        $count = $this->transaction->products()->where('product_id', $this->selected_product->id)->get()->sum('pivot.quantity');
        if ($this->selected_product->stock->quantity < $count + $this->selected_quantity) return $this->sweetAlert('error', 'Not enough products in stock!', '', 'bottom-end', 2000);
        if ((int)$this->selected_quantity > $this->selected_product->stock->quantity) return $this->sweetAlert('error', 'Not enough products in stock!', '', 'bottom-end', 2000);

        $product = $this->transaction->products()->where('product_id', $this->selected_product->id)->wherePivot('sell_price', $this->selected_price * 100)->first();
        if ($product) {
            $new_quantity = $product->pivot->quantity + $this->selected_quantity;
            $product->pivot->update([
                'quantity' => $new_quantity,
                'discount' => $new_quantity * ($product->srp - $product->pivot->sell_price),
            ]);
            $this->selected_product = null;
            $this->selected_quantity = 1;
            $this->selected_price = 0;
            $this->discount = 5;
            $this->transaction = Transaction::with('products')->find($this->transaction->id);
            return $this->sweetAlert('success', 'Product added to sale!', '', 'bottom-end', 1200);
        }

        DB::transaction(function () {
            $this->transaction->products()->attach($this->selected_product, [
                'quantity' => $this->selected_quantity,
                'sell_price' => $this->selected_price,
                'discount' => ($this->selected_product->srp - $this->selected_price) * $this->selected_quantity,
            ]);
        });
        $this->selected_product = null;
        $this->selected_quantity = 1;
        $this->selected_price = 0;
        $this->discount = 5;
        $this->transaction = Transaction::with('products')->find($this->transaction->id);
        $this->sweetAlert('success', 'Product added to sale!', '', 'bottom-end', 1200);
    }

    public function applyDiscount()
    {
        if ($this->discount < 0 || $this->discount > 100) return $this->sweetAlert('error', 'Invalid discount.', 'Must be between 0 and 100');
        $new_price = round($this->selected_price -  $this->discount / 100 * $this->selected_price, 3);
        $this->selected_price = number_format($new_price, 2, '.', '');
        $this->sweetAlert('success', 'Discount applied!', '', 'bottom-end', 1200);
    }

    public function updatedSelectedQuantity($value)
    {
        if ((int)$value <= 0) $this->selected_quantity = 1;
    }
    public function updatedSelectedPrice($value)
    {
        if ((float)$value <= 0) $this->selected_price = number_format($this->selected_product->srp, 2, '.', '');
    }


    public function removeProduct($pivot_id)
    {
        $this->transaction->products()->wherePivot('id', $pivot_id)->detach();
        $this->transaction = Transaction::with('products')->find($this->transaction->id);
        $this->sweetAlert('success', 'Product removed from sale!', '', 'bottom-end', 1200);
    }

    public function sweetAlert($type = 'info', $text = 'Oh no!', $subtext = "", $position = 'top-end', $timer = 3000, $toast = true, $showCancel = false, $showConfirm = false)
    {
        $this->alert($type, $text, [
            'position' =>  $position,
            'timer' =>  $timer,
            'toast' =>  $toast,
            'text' =>  $subtext,
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  $showCancel,
            'showConfirmButton' =>  $showConfirm,
        ]);
    }

    public function printInvoice()
    {
        $t = $this->transaction->id;
        $saved = $this->finalizeTransaction();
        if ($saved) $this->dispatchBrowserEvent('print-invoice', ['transaction' => $t]);
    }

    public function finalizeTransaction()
    {
        $this->validate();
        $amount_tendered = (float)$this->amount_tendered;
        if ($amount_tendered < $this->transaction->sales) return $this->alert('error', 'Not enough payment was made.');
        if (!$this->transaction->products()->count())
            return $this->alert('error', 'No products added to sale.');
        foreach ($this->transaction->products as $key => $product) {
            $product->stock->update([
                'quantity' => $product->stock->quantity - $product->pivot->quantity,
            ]);
        }
        $this->transaction->update([
            'code' => Carbon::now()->timestamp,
            'total_sales' => $this->transaction->sales,
            'total_discount' => $this->transaction->discount,
            'amount_tendered' => $amount_tendered,
            'is_final' => true,
        ]);
        $change = $amount_tendered - $this->transaction->total_sales;
        $this->selected_product = null;
        $this->selected_quantity = 1;
        $this->selected_price = 0;
        $this->discount = 5;
        $this->amount_tendered = 0;
        $this->transaction = Transaction::where('is_final', false)->with('products')->firstOrCreate();
        $this->paymentModal = false;
        $this->sweetAlert('success', "Transaction complete. Total change is &#8369; " . number_format($change, 2) . '.', 'Thank you and come again!', 'center', 0, false);
        return true;
    }
}