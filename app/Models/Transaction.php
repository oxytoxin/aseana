<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->using(ProductTransaction::class)->withPivot(['id','sell_price','quantity','discount'])->latest();
    }

    public function getTotalSalesAttribute()
    {
        return $this->products->map(function($p){
            return $p->pivot->sell_price * $p->pivot->quantity;
        })->sum();
    }
    public function getTotalDiscountAttribute()
    {
        return $this->products->sum('pivot.discount');
    }
    public function getTotalQuantityAttribute()
    {
        return $this->products->sum('pivot.quantity');
    }

    public function getTotalUnitsAttribute()
    {
        $str = '';
        $units = $this->products->groupBy('unit.id')->map(function($unit){
            return $unit->sum('pivot.quantity');
          });
          foreach ($units as $key => $unit) {
              $u = Unit::find($key);
              $str .= $unit . ' ';
              $unit > 1 ? $str .= $u->plural : $str .= $u->name;
              if($key != array_key_last($units->toArray())) $str .= ', ';
          }
        return $str;
    }
}
