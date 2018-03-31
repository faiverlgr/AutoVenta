<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
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
            'tipdoc'    =>  'required | numeric',
            'nrodoc'    =>  'required | max:15',
            'nombres'   =>  'required | max:25',
            'apellidos' =>  'required | max:25',
            'razons'    =>  'required | max:30',
            'direccion' =>  'required | max:45',
            'idciudad'  =>  'required | numeric',
            'telefono1' =>  'required | max:15',
            'telefono2' =>  'max:15',
            'email'     =>  'required | max:30',
        ];
    }
}
