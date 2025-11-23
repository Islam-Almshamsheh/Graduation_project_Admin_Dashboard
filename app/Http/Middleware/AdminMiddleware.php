<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('admin')) {
            return redirect()->route('login')->withErrors(['login' => 'You must be logged in as admin.']);
        }

        return $next($request);
    }
}
