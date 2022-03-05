<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function repair()
    {
        return $this->hasOne(Repair::class);
    }

    public function return_to_supplier_item()
    {
        return $this->hasOne(return_to_supplier_item::class);
    }
}
