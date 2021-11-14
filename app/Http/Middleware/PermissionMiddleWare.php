<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class PermissionMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $slug, $perm)
    {

        if(Auth::check() && $request->user()->hasPermission($slug, $request->user()->usertype, $perm)) return $next($request);
        else 
            return redirect()->back()->withErrors([
                'Apologies, you seems not to have permission to access this resource.'
            ])->withInput($request->all());
    }
}
