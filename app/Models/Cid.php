<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cid extends Model
{
    protected $table = "walt_cid";
    public $timestamps = true;
    protected $fillable = [ 'code', 'description' ];
}