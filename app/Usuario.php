<?php

namespace PruebaInsoftar;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['cedula','nombres', 'apellidos', 'correo','telefono'];
}
