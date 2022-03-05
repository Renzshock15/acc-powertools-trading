<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function brand()
    {
        return $this->hasOne(Brand::class);
    }

    public function return_to_supplier()
    {
        return $this->hasOne(Return_to_supplier::class);
    }
}
