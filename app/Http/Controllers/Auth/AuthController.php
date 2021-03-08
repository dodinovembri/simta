<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		if(Auth::check()){
	        if(Auth::user()->role_id == 1){                          
	        	$redirectTo = '/admin';          
	        }else if (Auth::user()->role_id == 2) {
	        	$redirectTo = '/pengelola';          

	        }else if (Auth::user()->role_id == 3) {
	        	$redirectTo = '/dosen';          
	        	
	        }else if (Auth::user()->role_id == 4) {            	
	        	$redirectTo = '/mhs';          

	        }else{
	        	$redirectTo = '/auth/login';
	        }			
		}else{
	        $redirectTo = '/auth/login';

		}

        $this->redirectTo = $redirectTo;
		$this->middleware('guest', ['except' => 'getLogout']);
	}
}
