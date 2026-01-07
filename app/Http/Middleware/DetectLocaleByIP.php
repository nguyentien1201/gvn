<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use GeoIP;

class DetectLocaleByIP
{
    public function handle($request, Closure $next)
    {
        // Nếu session đã có locale thì set luôn và bỏ qua detect
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
            return $next($request);
        }

        // Detect lần đầu
        $location = geoip()->getLocation($request->ip());

        // Nếu Việt Nam thì set vi, ngược lại set en
        if (
            strtolower($location->country) === 'vietnam' ||
            strtolower($location->iso_code) === 'vn'
        ) {
            $locale = 'vi';
        } else {
            $locale = 'en';
        }

        // Lưu vào session để lần sau không detect nữa
        session(['locale' => $locale]);

        // Set locale cho request hiện tại
        App::setLocale($locale);

        return $next($request);
    }
}
