<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        return $value/100;
    }
    public function setSrpAttribute($value)
    {
        return $this->attributes['srp'] = $value*100;
    }
}
