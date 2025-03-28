<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'admin') {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('error', 'Unauthorized access');
    }
} 