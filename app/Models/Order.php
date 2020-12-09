<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
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