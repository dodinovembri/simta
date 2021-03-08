<?php namespace App\Http\Middleware;
// First copy this file into your middleware directoy
use Closure;
use Auth;
class CheckRole{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    // pengecekan redirect setiap routes berdasarkan role
    $roles = $this->getRequiredRoleForRoute($request->route());
    if (Auth::check()) {
      if($request->user()->hasRole($roles))
      {
        return $next($request);
      }else{
        if(Auth::user()->role_id == 1){                          
          return redirect('admin');          
        }else if (Auth::user()->role_id == 2) {
          return redirect('pengelola');
        }else if (Auth::user()->role_id == 3) {
          return redirect('dosen');
        }else if (Auth::user()->role_id == 4) {             
          return redirect('mhs');
        }else{
          return redirect('mhs');
        }      
      }
    }else{
      return redirect('auth/login');
    }

  }
  private function getRequiredRoleForRoute($route)
  {
    $actions = $route->getAction();
    return isset($actions['roles']) ? $actions['roles'] : null;
  }
}