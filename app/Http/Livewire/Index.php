<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $quantity;
    public $weekly_sales;

    public function mount()
    {
        $this->quantity = Product::get()->shuffle()->pluck('stock.quantity');
    }

    public function render()
    {
        // $this->weekly_sales = Transaction::thisWeek()->get()->groupBy(function ($item) {
        //     return $item->updated_at->format('l');
        // })->map(function ($week) {
        //     return $week->sum('total_sales');
        // })->flatten()->toArray();
        function callback()
        {
        }
        $this->weekly_sales = Transaction::thisWeek()->get()->groupBy(function ($item) {
            return $item->updated_at->format('w');
        })->map(function ($week) {
            return $week->sum('total_sales');
        })->toArray();
        $final = array_fill(0, 7, 0);
        $this->weekly_sales = array_map(function ($k, $e) {
            return array_key_exists($k, $this->weekly_sales) ? $this->weekly_sales[$k] : $e;
        }, array_keys($final), $final);
        $popular = Transaction::get()->pluck('products')->flatten()->groupBy('name')->map(function ($item) {
            return ['quantity' => $item->sum('pivot.quantity')];
        })->sortByDesc('quantity')->take(5);
        $warning = Product::warningStocks()->get()->sortBy('stock.quantity');
        return view('livewire.index', [
            'popular' => $popular,
            'warning' => $warning,
        ])
            ->extends('layouts.master')
            ->section('content');
    }
}