<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkauth
{
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            return redirect('crm');
        } else {
            return $next($request);
        }
    }
}
