<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $table = "walt_query";
    public $timestamps = true;
    protected $fillable = [
        'patient', 'user', 'date_query'
    ];
}