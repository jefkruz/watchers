<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsGuest
{

    public function handle(Request $request, Closure $next)
    {

        return (session('guest')) ? $next($request) : to_route('signIn');

    }
}
