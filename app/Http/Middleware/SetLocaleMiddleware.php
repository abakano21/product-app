<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleMiddleware
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

        $locale = $request->session()->get('locale');
        $region = $request->session()->get('region');
        
        if($locale == null) {
            session(['locale' => request()->segment(2)]);
        }

        // If not set, then set region
        if($region == null) {
            session(['region' => request()->segment(3)]);
        }

        return $next($request);
    }
}
