<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }
}
