<?php

namespace App\Http\Middleware;

use Closure;


class Checkpermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission = null)
    {
        $auth_permissions = [
            'product-list',
            'role-list'
        ];
        dd($permission);
        if(in_array($permission,$auth_permissions)){
            return $next($request);
        }
        return back()->with('success', 'You do not have permission.');
    }
}
