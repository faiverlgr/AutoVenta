<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Red extends Model
{
    //use Notifiable;
    protected $table='redes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codred',
        'desred',
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
