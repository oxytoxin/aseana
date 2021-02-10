<?php

namespace App\Models;

use App\Models\ProductTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class)->using(ProductTransaction::class)->latest();
    }

    public function getSrpAttribute($value)
    {
        return $value / 100;
    }
    public function setSrpAttribute($value)
    {
        return $this->attributes['srp'] = $value * 100;
    }

    public function scopeWithStocks($query)
    {
        return $query->addSelect(['items_instock' => Stock::select('quantity')->whereColumn('product_id', 'products.id')]);
    }

    public function scopeWarningStocks($query)
    {
        return $query->whereHas('stock', function (Builder $q) {
            $q->whereColumn('quantity', '<', 'warning');
        });
    }
}