<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class bendahara
{

    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }
    //tambahan
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role->name == "pelanggan" && Auth::user()->status == 1) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
