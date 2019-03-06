<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipts extends Model
{
    protected $table = "walt_receipts";
    public $timestamps = true;
    protected $fillable = [ 'finances_id', 'cpf', 'value', 'description' ];
}