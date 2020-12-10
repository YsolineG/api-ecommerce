<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['name', 'price', 'description', 'stock'];

    protected $casts = [
        'price' => 'float'
    ];

    public function categories()
    {
         return $this->belongsToMany(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}

