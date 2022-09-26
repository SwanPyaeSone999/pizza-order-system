<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
    ];
    protected $appends = ['total_price'];

    public function getTotalPriceAttribute()
    {
        return $this->qty * $this->pizza_price;
    }
}