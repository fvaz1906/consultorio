<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeMedicine extends Model
{
    protected $table = "walt_recipe_medicine";
    public $timestamps = true;
    protected $fillable = [ 'id_recipe', 'id_medicine' ];
}