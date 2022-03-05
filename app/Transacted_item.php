<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transacted_item extends Model
{
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
