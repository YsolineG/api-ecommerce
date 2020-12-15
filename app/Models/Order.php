<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model {
    use HasFactory;

    protected $fillable = ['customer_id'];

      public function customer()
      {
          return $this->hasOne(Customer::class);
      }

      public function products()
      {
          return $this->belongsToMany(Product::class)->withPivot('quantity');
      }
}