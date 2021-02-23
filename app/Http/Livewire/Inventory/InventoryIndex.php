<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Product;
use Livewire\Component;

class InventoryIndex extends Component
{
    public $search = '';
    public $product;
    public $threshold;
    public $restock;
    public $showWarning = false;
    public $showRestock = false;

    public function mount()
    {
        session(['page' => 'inventory.index']);
    }

    public function render()
    {
        $products = Product::query();
        if ($this->search) $products = $products->where('name', 'like', "%$this->search%");
        $products = $products->with(['unit', 'stock'])->withLastRestock()->get()->sortBy('stock.quantity');
        return view('livewire.inventory.inventory-index', [
            'products' => $products,
        ])
            ->extends('layouts.master')
            ->section('content');
    }

    public function showWarning(Product $product)
    {
        $this->product = $product;
        $this->threshold = $product->stock->warning;
        $this->showWarning = true;
    }

    public function updateThreshold()
    {
        $this->validate([
            'threshold' => 'required|numeric|min:0',
        ]);
        $this->product->stock->update(['warning' => $this->threshold]);
        $this->showWarning = false;
        $this->alert('success', 'Warning threshold updated.');
    }
    public function showRestock(Product $product)
    {
        $this->product = $product;
        $this->showRestock = true;
    }

    public function updateStock()
    {
        $this->validate([
            'restock' => 'required|numeric|min:0',
        ]);
        $this->product->stock->update(['quantity' => $this->product->stock->quantity + $this->restock]);
        $this->product->restocks()->create([
            'quantity' => $this->restock,
        ]);
        $this->showRestock = false;
        $this->restock = '';
        $this->alert('success', 'Stocks updated.');
    }
}