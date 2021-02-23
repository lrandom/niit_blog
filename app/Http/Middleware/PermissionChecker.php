<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class PermissionChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $allowsRoles = explode('|', $roles);
        if (in_array(Auth::user()->getStrType(), $allowsRoles)) {
            return $next($request);
        }
        return redirect()->route('403');
    }
}
