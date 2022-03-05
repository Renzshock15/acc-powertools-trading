<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function transaction_type()
    {
        return $this->belongsTo(Transaction_type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction_comment()
    {
        return $this->hasOne(Transaction_comment::class);
    }

    public function transacted_items()
    {
        return $this->hasMany(Transacted_item::class);
    }

    public function transacted_item()
    {
        return $this->hasOne(Transacted_item::class);
    }

    public function temp_transfer_lists()
    {
        return $this->hasMany(Temp_transfer_list::class);
    }

    public function temp_transfer_list()
    {
        return $this->hasOne(Temp_transfer_list::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function transaction_cancelation()
    {
        return $this->hasOne(Transaction_cancelation::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
}
