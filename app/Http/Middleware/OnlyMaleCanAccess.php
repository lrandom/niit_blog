<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class OnlyMaleCanAccess
{

    // Authentication
    // Authorization
    // Nhóm quyền
    // Quyền
    // X
    //     x1
    //     x2
    // Y
    //     x1
    //     y1
    // php artisan make:middleware <Ten Middleware>
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->gender == 1) {
            return $next($request);
        }
        return redirect()->route('403');
    }
}
