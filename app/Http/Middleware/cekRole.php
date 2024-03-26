<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;


class cekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }
        //kalau tidak bakal diarahkan ke halaman yang munculkan error not found
        return redirect('/error');
    }
}