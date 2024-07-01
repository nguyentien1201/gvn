<?php


namespace App\Http\Controllers\Front;


use Illuminate\Support\Facades\Request;
use App\Models\SignalFree;
use App\Models\MstStock;
class HomeController
{
    public function index(Request $request)
    {
       $signals = (new SignalFree())->getListSignalsFree();
        return view('front.home',compact('signals'));
    }
}
