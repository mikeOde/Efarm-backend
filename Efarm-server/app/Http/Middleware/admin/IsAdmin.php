<?php

namespace App\Http\Middleware\admin;

use Closure;
use Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->user_type_id == 1) {
            return $next($request);
        }

        return redirect(route('api:test'))->with('error','You do not have admin access');
    }
}