<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ForceLocaleForPage
{
    public function handle($request, Closure $next)
    {
        // Nếu URL hiện tại là 'about' (hoặc route name)
        if ($request->is('greenstock-vnindex')) {
            App::setLocale('vi'); // hoặc 'vi', 'ja', ...
        }

        return $next($request);
    }
}
