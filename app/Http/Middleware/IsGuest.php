<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsGuest
{

    public function handle(Request $request, Closure $next)
    {
        if (!session('guest')) {
            session(['guest.intended' => url()->current()]);
            return redirect()->route('signIn');
        }
        return $next($request);
//        return (session('guest')) ? $next($request) : to_route('signIn');

    }
}
