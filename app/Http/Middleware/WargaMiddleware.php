<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class WargaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->where('verified_at', '!=', null)->where('status_tinggal_id', 1)->with('rumah')->first();
        if($keluarga == null){
            return redirect()->back();
        }
        else {
            return $next($request);
        }
    }
}
