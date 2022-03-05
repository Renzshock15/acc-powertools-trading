<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function transfer_list()
    {
        return $this->hasOne(Transfer_list::class);
    }

    public function transacted_item()
    {
        return $this->hasOne(Transacted_item::class);
    }

    public function temp_transfer_list()
    {
        return $this->hasOne(Temp_transfer_list::class);
    }
}
