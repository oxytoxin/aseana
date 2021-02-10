<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $dates = ['restocked_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getLastRestockedDateAttribute()
    {
        return $this->updated_at->format('M d, Y');
    }
    public function getLastRestockedTimeAttribute()
    {
        return $this->updated_at->format('g:i a');
    }
}