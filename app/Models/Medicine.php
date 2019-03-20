<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = "walt_medicine";
    public $timestamps = true;
    protected $fillable = [ 'medicine', 'active_principle', 'concentration' ];
}