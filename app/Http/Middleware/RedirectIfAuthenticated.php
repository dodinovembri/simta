<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// pengecekan redirect setelah login
		if ($this->auth->check())
		{
	        if($this->auth->user()->role_id == 1){                          
				return new RedirectResponse(url('/admin'));
	        }else if ($this->auth->user()->role_id == 2) {
				return new RedirectResponse(url('/pengelola'));

	        }else if ($this->auth->user()->role_id == 3) {
				return new RedirectResponse(url('/dosen'));
	        }else if ($this->auth->user()->role_id == 4) {            	
				return new RedirectResponse(url('/mhs'));
	        }else{
				return new RedirectResponse(url('/auth/login'));
	        }			
		}

		return $next($request);
	}

}
