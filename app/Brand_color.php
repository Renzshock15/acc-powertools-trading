<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand_color extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
