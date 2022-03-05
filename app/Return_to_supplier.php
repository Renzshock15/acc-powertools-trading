<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Return_to_supplier extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function return_to_supplier_item()
    {
        return $this->hasOne(Return_to_supplier_item::class);
    }
}
