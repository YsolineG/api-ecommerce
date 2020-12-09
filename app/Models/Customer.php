<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $fillable = ['name', 'firstname', 'email', 'adress'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}