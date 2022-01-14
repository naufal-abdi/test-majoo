<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Admin extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $guard = 'admin';
    protected $table = 'admin';
    protected $fillable = [
        'email', 'name', 'password'
    ];
    protected $hidden = ['password'];
}
