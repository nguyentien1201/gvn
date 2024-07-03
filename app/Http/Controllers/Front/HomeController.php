<?php


namespace App\Http\Controllers\Front;


use App\Models\GreenBeta;
use Illuminate\Support\Facades\Request;
use App\Models\SignalFree;
use App\Models\MstStock;
use DB;
class HomeController
{
    public function index(Request $request)
    {
        $signals = (new SignalFree())->getListSignalsFree();
        $favarite_code = config('stock.favorite');
        $stocks = MstStock::whereIn('code',$favarite_code)->pluck('id')->toArray();
        $favorite = GreenBeta::select('*', DB::raw('MAX(close_time) as close_time'))->whereIn('code',$stocks)->with(['MstStock'])->groupBy('code')->orderBy('close_time', 'desc')->get();

        foreach ($favorite as $key => $value) {
            $value->code = $value->MstStock->code;
            $favorite[$key] = $value;
        }
        $last_signal = GreenBeta::select('*', DB::raw('MAX(updated_at) as updated_at'))->whereIn('code',$stocks)->with(['MstStock'])->groupBy('code')->orderBy('updated_at', 'desc')->get();
        foreach ($favorite as $key => $value) {
            $value->code = $value->MstStock->code;
            $favorite[$key] = $value;
        }
        return view('front.home',compact('signals','favorite','last_signal'));
    }
}
