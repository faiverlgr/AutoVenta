<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalidadesRequest extends FormRequest
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
            'idred'=>'required',
            'idzon'=>'required',
            'codloc'=>'required | max:3',
            'nomloc'=>'required | max:35',
            'desloc'=>'max:190'
        ];
    }
}
