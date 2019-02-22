<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "walt_usuarios";
    
    public $timestamps = true;

    protected $fillable = [
        'email', 'name', 'password', 'token'
    ];
}