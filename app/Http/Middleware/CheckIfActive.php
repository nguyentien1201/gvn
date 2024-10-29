<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfActive
{
    public function handle($request, Closure $next)
    {

        // Check if the user is authenticated
        if (Auth::check()) {
            if(Auth::user()->is_active == 1){
                return $next($request);
            }

        }
        session()->flash('error', 'Your account is not active. Please contact support.');
        return redirect()->route('inactive');


    }
}
