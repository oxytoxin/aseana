<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductIndex extends Component
{
    public $showCreate = false;
    public $product;
    public $product_name = "";
    public $search = "";
    public $product_unit = 1;
    public $product_srp = "";
    public $editing = false;

    protected $rules = [
        'product_name' => "required",
        'product_srp' => "required|numeric|min:0",
    ];

    protected $listeners = ['confirmed', 'cancelled'];

    public function confirmed()
    {
        $this->product->delete();
        $this->product = null;
        $this->alert('success', 'Product successfully deleted.');
    }

    public function mount()
    {
        session(['page' => 'products.index']);
    }

    public function render()
    {
        $products = Product::query();
        if ($this->search) $products =  $products->where('name', 'like', "%$this->search%");
        $products = $products->orderBy('name')->get();
        return view('livewire.products.product-index', [
            'products' => $products,
            'units' => Unit::get(),
        ])
            ->extends('layouts.master')
            ->section('content');
    }

    public function addProduct()
    {
        $this->validate();
        if ($this->editing) {
            $this->product->update([
                'name' => $this->product_name,
                'srp' => $this->product_srp,
                'unit_id' => $this->product_unit
            ]);
        } else {
            DB::transaction(function () {
                $p = Product::create([
                    'name' => $this->product_name,
                    'srp' => $this->product_srp,
                    'unit_id' => $this->product_unit
                ]);
                $p->stock()->create([
                    'restocked_at' => Carbon::now(),
                ]);
                $p->restocks()->create([
                    'quantity' => 0,
                ]);
            });
        }
        if ($this->editing) {
            $this->alert('success', 'Product has been updated!');
        } else {
            $this->alert('success', 'Product has been added!');
        }
        $this->product_name = "";
        $this->product_srp = "";
        $this->product_unit = 1;
        $this->showCreate = false;
    }

    public function showEdit(Product $product)
    {
        $this->editing = true;
        $this->product = $product;
        $this->product_name = $product->name;
        $this->product_srp = $product->srp;
        $this->product_unit = $product->unit_id;
        $this->showCreate = true;
    }

    public function deleteProduct(Product $product)
    {
        $this->product = $product;
        $this->confirm('Are you sure you want to delete this product?', [
            'toast' => true,
            'position' => 'bottom',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
        ]);
    }
}