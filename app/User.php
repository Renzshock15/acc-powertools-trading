<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function access()
    {
        return $this->belongsTo(Access::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function transfer_list()
    {
        return $this->hasOne(Transfer_list::class);
    }

    public function transaction_cancelation()
    {
        return $this->hasOne(Transaction_cancelation::class);
    }

    public function repair()
    {
        return $this->hasOne(Repair::class);
    }
}
