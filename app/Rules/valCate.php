<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Entities\Categoria;
use DB;

class valCate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $valor)
    {
        $codfpro = substr($valor, 0, 2);
        $codfcat = substr($valor, 2);
        
        unset($codigo); 
        $codigo = DB::table('categorias')
            ->where('codprov', '=', $codfpro)
            ->where('codcate', '=', $codfcat)
            ->first();
        
        //dd($codigo);
        if (empty($codigo)) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El código ingresado ya existe.';
    }
}
