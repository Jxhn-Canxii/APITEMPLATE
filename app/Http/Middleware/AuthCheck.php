<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        // If session is missing, redirect to SmartBarangay Connect login
        if (!Session::has('email')) {
            return Redirect::away('https://smartbarangayconnect.com/')->send();
        }

        return $next($request);
    }
}
