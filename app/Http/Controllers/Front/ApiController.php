<?php


namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use App\Models\GreenAlpha;
use App\Models\MstStock;
use Carbon\Carbon;
use App\Notifications\SendTelegramNotification;
use Illuminate\Support\Facades\Notification;
class ApiController
{
    public function postSignal(Request $request)
    {
        $request = Request::all();
        \Log::info(json_encode($request));
        $message ="";
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
        $timeSendTelegram = Carbon::parse($time)->format('H:i:s Y-m-d');
        $current_version = config('config.current_version');
        $today = Carbon::today()->toDateString();
        $no_trading = GreenAlpha::whereDate('open_time', '=', $today)->where('code',$listCode[$signal[0]])->count();
        if(in_array($signal[1],$signalClose) ){
            $signalData = [
                'code' => $listCode[$signal[0]],
                'signal_close'=> $signal[1],
                'price_close'=> $signal[2],
                'close_time'=> $timeFormat,
                'version' =>$current_version
            ];

            $existSignal = GreenAlpha::where('code', $listCode[$signal[0]])->whereNull('close_time')->whereDate('open_time', '=', $signal[3])->first();
            if(empty($existSignal)) return  ['status' => 'error', 'message' => 'No signal recived'];

            $profit =0;
            $open_price = (float)$existSignal->price_open ?? 0;
            if($existSignal->signal_open =='BUY'){
                $profit = (float)$signalData['price_close'] - (float)$existSignal->price_open;
            }else{
                $profit = (float)$existSignal->price_open - (float)$signalData['price_close'] ;
            }
            $signalData['profit'] = $profit;
            $perce_profit = $profit/$open_price*100;
            $existSignal->update($signalData);
            $message = "Symbol: <b>".$signal[0]." - No: ".$no_trading."</b>\nSignal: <b>".$signalData['signal_close']."</b>\nPrice Close: <b>".$signalData['price_close']."</b>\n"."Profit: <b>".round($perce_profit,2).'%('.round($profit, 2)." pts)</b>"."\nTime: <b>".$timeSendTelegram."</b>";
        }
        if(in_array($signal[1],$signalOpen) ){
            $signalData = [
                'code' => $listCode[$signal[0]],
                'signal_open'=> $signal[1],
                'price_open'=> $signal[2],
                'open_time'=> $timeFormat,
                'version' =>$current_version
            ];

            $no_trading = $no_trading+1;
            GreenAlpha::create($signalData);
            $message = "Symbol: <b>".$signal[0]."- No: ".$no_trading ."</b>\nSignal: <b>".$signalData['signal_open']."</b>\nPrice Open:  <b>".$signalData['price_open']."</b>\nTime: <b>".$timeSendTelegram."</b>";
        }
        try {
            Notification::route('telegram', config('telegram.group_id'))->notify(new SendTelegramNotification($message));
        } catch (\Exception $e) {
            \Log::info($message);
            \Log::error($e->getMessage());
        }

        return  ['status' => 'success', 'message' => 'Recived signal'];
    }
}
