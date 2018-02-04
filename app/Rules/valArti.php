<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Entities\Articulo;
use DB;

class valArti implements Rule
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
    public function passes($attribute, $value)
    {
        $codfpro = substr($value, 0, 2);
        $codfcat = substr($value, 2,4);
        $codfart = substr($value, 6);
        
        unset($codigo); 
        $codigo = DB::table('articulos')
            ->where('codprov', '=', $codfpro)
            ->where('codcate', '=', $codfcat)
            ->where('codarti', '=', $codfart)
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
