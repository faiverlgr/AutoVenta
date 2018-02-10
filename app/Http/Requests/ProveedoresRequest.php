<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedoresRequest extends FormRequest
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
            // el primero es el nombre en del campo en el formulario
            'codprov'=>' required | max:2 | unique:proveedores,codprov',
            'nit'=>'max:20',
            'razons'=>'required | max:100',
            'sigla'=>'max:50',
            'direccion'=>'required | max:80',
            'telefono1'=>'max:20',
            'telefono2'=>'max:20',
            'email'=>'max:80'
        ];
    }
}
