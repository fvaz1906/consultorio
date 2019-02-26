<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "walt_patient";
    public $timestamps = true;
    protected $fillable = [ 
        'name','sex','date_birth','cpf','cellphone',
        'email','color','cep','street','number',
        'neighborhood','complement','city','state','agreement'
    ];
}