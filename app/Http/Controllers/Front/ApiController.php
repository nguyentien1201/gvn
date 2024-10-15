<?php


namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use App\Models\GreenBeta;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use App\Models\GreenAlpha;
use App\Models\GreenStockNas100;
use DB;
use App\Models\SubGroup;
use App\Models\Ma;
use Illuminate\Support\Facades\Cache;
use App\Models\GroupCap;
use App\Models\SubGroupCapDetail;
use DateTime;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\ConstantModel;
use App\Models\Subscription;
use App\Models\MstStock;
use Carbon\Carbon;
class ApiController
{
    public function postSignal(Request $request)
    {
        $request = Request::all();
        \Log::info(json_encode($request));
        $param = $request['data'] ?? '';
        if(empty($param)){
            return  ['status' => 'error', 'message' => 'No signal recived'];
        }
        $signal = explode(' ', $param);

        $signalClose = ['TakeProfitBUY', 'TakeProfitSELL', 'CutLossBUY', 'CutLossSELL'];
        $signalOpen = ['BUY', 'SELL'];
        $listCode = MstStock::pluck('id','code')->toArray();

        $time = str_replace('.', '-',$signal[3]).' '.$signal[4];
        $timeFormat = Carbon::parse($time)->format('Y-m-d H:i:s');

        if(in_array($signal[1],$signalClose) ){
            $signalData = [
                'code' => $listCode[$signal[0]],
                'signal_close'=> $signal[1],
                'price_close'=> $signal[2],
                'close_time'=> $timeFormat,
            ];
            GreenAlpha::where('code', $listCode[$signal[0]])->whereNull('close_time')->whereDate('open_time', '=', $signal[3])->update($signalData);
        }
        if(in_array($signal[1],$signalOpen) ){
            $signalData = [
                'code' => $listCode[$signal[0]],
                'signal_open'=> $signal[1],
                'price_open'=> $signal[2],
                'open_time'=> $timeFormat,
            ];
            GreenAlpha::create($signalData);
        }
        return  ['status' => 'success', 'message' => 'Recived signal'];
    }
}
