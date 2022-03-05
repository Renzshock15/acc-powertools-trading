<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function transfer_list()
    {
        return $this->hasOne(Transfer_list::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }

    public function access()
    {
        return $this->belongsTo(Access::class);
    }

    public function repair()
    {
        return $this->hasOne(Repair::class);
    }
}
