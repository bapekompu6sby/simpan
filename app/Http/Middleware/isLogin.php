<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('nama') && session()->has('email') && session()->has('username') && session()->has('id') && session()->has('logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
