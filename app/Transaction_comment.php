<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_comment extends Model
{
    //
    public function transaction()
    {
        return $this->belongsTo(transaction::class);
    }
}
