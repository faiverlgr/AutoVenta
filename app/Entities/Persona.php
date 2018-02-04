<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'documento', 
        'nombre1', 
        'nombre2', 
        'apellido1', 
        'apellido2', 
        'email', 
        'telefono1', 
        'telefono2', 
        'barrio',
        'ciudad',
        'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
