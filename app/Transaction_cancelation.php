<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_cancelation extends Model
{
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
