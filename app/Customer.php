<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function repair()
    {
        return $this->hasOne(Repair::class);
    }
}
