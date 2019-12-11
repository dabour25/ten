<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyAdmin extends Authenticatable
{
    protected $guard = 'myadmin';
    protected $table="myadmin";
    protected $fillable = [
        'email', 'password','secret_key'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
