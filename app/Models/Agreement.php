<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $table = "walt_agreement";
    public $timestamps = true;
    protected $fillable = [ 'agreement' ];
    public function relationPatient()
    {
        return $this->hasMany('App\Models\Patient', 'agreement');
    }
}