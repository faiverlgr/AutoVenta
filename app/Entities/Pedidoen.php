<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Pedidoen extends Model
{
    //use Notifiable;
    protected $table='ingresde';
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idingresen',
        'idbod',
        'idarti',
        'cantidad',
        'vcosto',
        'vneto',
        'piva',
        'vtotal',
        'vtmarg'
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
