<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjustesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //encabezado
            'idper'         =>'required | integer',
            'idtipo'        =>'required | integer',
            'idconcepto'    =>'required | integer',
            'fecha'         =>'required | date',
            'tcosto'        =>'required | numeric',
            'tneto'         =>'required | numeric',
            'tventa'        =>'required | numeric',
            'tiva'          =>'required | numeric',
            
            //'estado'        =>'required | boolean',
            
            //detalle
            /*
            'idajen'    =>'required | integer',
            'idbod'     =>'required | integer',
            'idarti'    =>'required | integer',
            'cantidad'  =>'required | numeric',
            'vcosto'    =>'required | numeric',
            'vneto'     =>'required | numeric',
            'piva'      =>'required | numeric',
            'vtotal'    =>'required | numeric'
            */
        ];
    }
}
