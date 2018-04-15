<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NegociosRequest extends FormRequest
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
            'idcli'     => 'required | numeric',
            'idred'     => 'required | numeric',
            'idzon'     => 'required | numeric',
            'idloc'     => 'required | numeric',
            'nomneg'    => 'required | max:45',
            'direccion' =>  'required | max:45',
            'idciudad'  =>  'required | numeric',
            'telefono'  =>  'required | max:15',
            'email'     =>  'required | max:30',
            'tipneg'    =>  'required | numeric',
        ];
    }
}