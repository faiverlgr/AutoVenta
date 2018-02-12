<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresosRequest extends FormRequest
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
            'idper'     =>  'required',
            'idprov'    =>  'required',
            'numdoc'    =>  'required | max:15',
            'fecha'     =>  'required | max:8',
            'fechav'    =>  'required | max:8',
            'tcosto'    =>  'required',
            'tmargen'   =>  'required',
            'tventa'    =>  'required',
            'tiva'      =>  'required',
            'estado'    =>  'required | max:1',
            // detalle
            'idingresen'    =>  'required',
            'idbod'         =>  'required',
            'idarti'        =>  'required',
            'cantidad'      =>  'required',
            'vcosto'        =>  'required',
            'vneto'         =>  'required',
            'piva'          =>  'required',
            'vtotal'        =>  'required',
            'vtmarg'        =>  'required',
        ];
    }
}
