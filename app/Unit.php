<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function product()
    {
        return $this->hasOne(Product::class);
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
