<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = "walt_recipe";
    public $timestamps = true;
    protected $fillable = [ 'id_doctor', 'id_patient', 'annotation' ];
}