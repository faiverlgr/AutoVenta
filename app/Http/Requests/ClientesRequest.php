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
            'tipdoc'    =>  'required | max:2 | numeric',
            'documento' =>  'required | max:15 | numeric',
            'nombres'   =>  'required | max:25',
            'apellidos' =>  'required | max:20',
            'razons'    =>  'max:30',
            'direccion' =>  'required | max:45',
            'idepto'    =>  'required | numeric',
            'idciudad'  =>  'required | numeric',
            'telefonos' =>  'max:25 | numeric',
            'email'     =>  'max:25',
            'estado'    =>  'required'
        ];
    }
}
