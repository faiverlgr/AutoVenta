<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ajustde extends Model
{
    //use Notifiable;
    protected $table='ajustde';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idajusten',
        'idbod',
        'idarti',
        'cantidad',
        'vcosto',
        'vneto',
        'piva',
        'vtotal'
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
