<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = "walt_exam";
    public $timestamps = true;
    protected $fillable = [ 'exam', 'material', 'normal_values', 'description' ];
}