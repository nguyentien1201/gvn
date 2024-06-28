<?php


namespace App\Http\Controllers\Front;


use Illuminate\Support\Facades\Request;

class HomeController
{
    public function index(Request $request)
    {
       //dd('sdf');

        return view('front.home');
    }
}
