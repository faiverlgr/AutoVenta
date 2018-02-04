<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\valArti;

class ArticulosRequest extends FormRequest
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
            'codprov'   =>  'required | max:2',
            'codcate'   =>  'required | max:4',
            'codarti'   =>  'required | max:4',
            'nombre'    =>  'required | max:100',
            'nombrec'   =>  'max:50',
            'vcosto'    =>  'required | numeric',
            'pmargen'   =>  'required | numeric',
            'vneto'     =>  'required | numeric',
            'piva'      =>  'required | numeric',
            'minimo'    =>  'required | numeric',
            'maximo'    =>  'required | numeric',
            'unidad'    =>  'max:50',
            'embalaje'  =>  'required | numeric',
            'cbarras'   =>  'max:50',
            'validaArti'=>  ['required', new valArti()]
        ];
    }
}
