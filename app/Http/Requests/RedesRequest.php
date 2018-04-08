<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedesRequest extends FormRequest
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
            'codred'=>' required | max:3 | unique:redes,codred',
            'desred'=>'required | max:25'
        ];
    }
}
