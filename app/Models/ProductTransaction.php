<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTransaction extends Pivot
{
    use HasFactory;
      /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    protected $guarded = [];
    protected $appends = ['subtotal'];

    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = $value * 100;
    }
    public function setSellPriceAttribute($value)
    {
        $this->attributes['sell_price'] = $value * 100;
    }
    public function getDiscountAttribute($value)
    {
        return $value / 100;
    }
    public function getSellPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->sell_price;
    }

}
