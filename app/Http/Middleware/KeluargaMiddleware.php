<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class KeluargaMiddleware
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
        $keluarga = Keluarga::where('createable_id', auth()->user()->id)->with('rumah')->first();
        if(!empty($keluarga)) {
            return redirect(route('user.keluarga.index'));
        }
        else {
            return $next($request);
        }
    }
}
