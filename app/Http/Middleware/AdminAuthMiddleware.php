<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AdminAuthMiddleware
{

    protected $user;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Session::has('user')){
            $this->user = Session::get('user');
        }

        if (strcmp($this->user['role'], 'admin') !== 0 && strcmp($this->user['role'], 'super-admin') !== 0){
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
