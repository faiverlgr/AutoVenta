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
        $codfpro = 0;
        $cCade="";     
        for ($i=0; $i < strlen($valor) ; $i++) { 
            $Letra = substr($valor,$i,1);
            if ($Letra <> "-") {
                $cCade = $cCade . $Letra;
            } else {
                $codfpro = (int)$cCade;
                $codfcat = substr($valor, $i+1);
                break;
            }
        }
        
        unset($codigo); 
        $codigo = DB::table('categorias')
            ->where('idprov', '=', $codfpro)
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
