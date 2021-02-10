<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->using(ProductTransaction::class)->withPivot(['id', 'sell_price', 'quantity', 'discount'])->latest();
    }

    public function getSalesAttribute()
    {
        return $this->products->map(function ($p) {
            return $p->pivot->sell_price * $p->pivot->quantity;
        })->sum();
    }
    public function getDiscountAttribute()
    {
        return $this->products->sum('pivot.discount');
    }
    public function getTotalSalesAttribute($value)
    {
        return $value / 100;
    }
    public function getTotalDiscountAttribute($value)
    {
        return $value / 100;
    }
    public function getAmountTenderedAttribute($value)
    {
        return $value / 100;
    }

    public function setTotalSalesAttribute($value)
    {
        $this->attributes['total_sales'] = $value * 100;
    }
    public function setTotalDiscountAttribute($value)
    {
        $this->attributes['total_discount'] = $value * 100;
    }
    public function setAmountTenderedAttribute($value)
    {
        $this->attributes['amount_tendered'] = $value * 100;
    }

    public function getTotalQuantityAttribute()
    {
        return $this->products->sum('pivot.quantity');
    }

    public function getTotalUnitsAttribute()
    {
        $str = '';
        $units = $this->products->groupBy('unit.id')->map(function ($unit) {
            return $unit->sum('pivot.quantity');
        });
        foreach ($units as $key => $unit) {
            $u = Unit::find($key);
            $str .= $unit . ' ';
            $unit > 1 ? $str .= $u->plural : $str .= $u->name;
            if ($key != array_key_last($units->toArray())) $str .= ', ';
        }
        return $str;
    }

    public function getDateForHumansAttribute()
    {
        return $this->updated_at->format('M d, Y - g:i a');
    }

    public function getChangeAttribute()
    {
        return $this->amount_tendered - $this->total_sales;
    }

    public function scopeThisWeek($query)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        return $query->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('is_final', true);
    }
}