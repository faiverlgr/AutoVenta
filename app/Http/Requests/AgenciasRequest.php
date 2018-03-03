<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgenciasRequest extends FormRequest
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
            'codage'    =>  'required | max:4 | unique:agencias,codage',
            'nitage'    =>  'max:15',
            'nombre'    =>  'required | max:50',
            'nomrepre'  =>  'required | max:50',
            'docrepre'  =>  'required | max:15',
            'direccion' =>  'required | max:80',
            'barrio'    =>  'required | max:80',
            'telefono1' =>  'max:15',
            'telefono2' =>  'max:15',
            'email'     =>  'max:80',
            'idbodega'  =>  'required',
            'idlista'   =>  'required'
        ];
    }
}
