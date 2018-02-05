<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\valCate;

class CategoriasRequest extends FormRequest
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
            'codprov'       =>  'required',
            'codcate'       =>  'required | max:4',
            'nomcate'       =>  'required | max:100',
            'validaCate'    =>  ['required', new valCate()]
        ];
    }
}
