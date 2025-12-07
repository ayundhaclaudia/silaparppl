<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'rating',          // <— tambah
        'reviews_count',
    ];

    public function carts()
    {
        return $this->hasMany(\App\Models\Cart::class);
    }

}
