<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_type extends Model
{
    //
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
