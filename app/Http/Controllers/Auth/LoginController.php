<?php
/**
 * EndpointHelper File Doc Comment
 * 
 * @category EndpointHelper
 * @package  Helper
 * @author   Brian Smith <brian.smith@company.com>
 * @license  GNU General Public License version 2 or later; see LICENSE
 * @link     http://arctg.com
 */
namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
/**
 * Constructor class
 * 
 */
class LoginController extends Controller
{
    /**
     * 
     */
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }
    /**
     * Constructor
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    /**
     * Constructor function
     */
    public function login()
    {
        $credentials = $this->validate(
            request(), [
            'user' => 'required|string',
            'password' => 'required|string'
            ]
        );
        //return $credentials;


        if (Auth::attempt($credentials)) {
            
            //return 'Autenticado correctamente';
            return redirect()->route('home');
        }
        
        //return 'Error en la autenticacion';
        return back()
            ->withErrors(['user' => trans('auth.failed')])
            ->withInput(request(['user']));
    }

    /**
     * Salida
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
