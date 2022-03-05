<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Return_to_supplier_item extends Model
{
    public function return_to_supplier()
    {
        return $this->belongsTo(Return_to_supplier::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
