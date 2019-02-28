<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finances extends Model
{
    protected $table = "walt_finances";
    public $timestamps = true;
    protected $fillable = [
        'cpf', 'value', 'description', 'type_movement'
    ];
}