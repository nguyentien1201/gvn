<?php

namespace App\Http\Middleware;

use App\Models\ConstantModel;
use App\Models\Subscription;
use Closure;
use Illuminate\Support\Facades\Auth;

class Product
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
      
        return $next($request);
    }
}
