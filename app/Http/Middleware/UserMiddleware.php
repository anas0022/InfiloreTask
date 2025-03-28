<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === null) {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('error', 'Unauthorized access');
    }
} 