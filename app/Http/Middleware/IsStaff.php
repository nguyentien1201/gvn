<?php

namespace App\Http\Middleware;

use App\Models\ConstantModel;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsStaff
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
        if (Auth::user()->role_id != ConstantModel::ROLES['company']) {
            abort(403);
        }
        return $next($request);
    }
}
