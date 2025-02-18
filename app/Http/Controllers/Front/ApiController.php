<?php


namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use App\Models\GreenAlpha;
use App\Models\MstStock;
use Carbon\Carbon;
use App\Notifications\SendTelegramNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\GreenBeta;
use Illuminate\Support\Facades\Cache;
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
            if($signal[1] =='BUY'){
                $color = '🟢';
            }else{
                $color = '🔴';
            }
            $no_trading = $no_trading+1;
            GreenAlpha::create($signalData);
            $message = "Symbol: <b>".$signal[0]."- No: ".$no_trading ."</b>\nSignal: <b>".$signalData['signal_open'].$color."</b>\nPrice Open:  <b>".$signalData['price_open']."</b>\nTime: <b>".$timeSendTelegram."</b>";
        }
        try {
            Notification::route('telegram', config('telegram.group_id'))->notify(new SendTelegramNotification($message));
        } catch (\Exception $e) {
            \Log::info($message);
            \Log::error($e->getMessage());
        }

        return  ['status' => 'success', 'message' => 'Recived signal'];
    }
    public function postSignalBeta(Request $request)
    {

        $request = Request::all();
        \Log::info(json_encode($request));

        $message ="";
        // $param = $request['data'] ?? '';
    //    $json_request = [
    //         "data" => "AUS200 TrendPrice UpTrend",
    //         "type" => 1
    //     ];
        $param = $request['data'] ?? '';
        $type = $request['type'] ?? 0;
        if(empty($param)){
            return  ['status' => 'error', 'message' => 'No signal recived'];
        }
        $signal = explode(' ', $param);
        $codes = MstStock::pluck('id','code')->toArray();

        // type =1 update trand price
        if($type == 1){
           $code = $codes[$signal[0]];
            $greenBeta = [
                'code' => $code,
                'trend_price' => $signal[2] ?? null,
            ];
            $beta = GreenBeta::where('code', $code)
            ->orderBy('open_time', 'desc')
            ->first();
            $beta->update($greenBeta);
            return  ['status' => 'success', 'message' => 'Recived signal'];
        }
        $signalClose = ['TakeProfitBUY', 'CutLossBUY',];
        $signalOpen = ['BUY', 'SELL'];
        // type =2 update   7h
        if($type ==2){
            $code = $codes[$signal[0]];
            $time = str_replace('.', '-',$signal[3]).' '.$signal[4];
            $timeFormat = Carbon::parse($time)->format('Y-m-d H:i:s');
            if(in_array($signal[1],$signalClose) ){
                $greenBeta = [
                    'code' => $code,
                    'signal_close'=> $signal[1],
                    'price_close'=> $signal[2],
                    'close_time'=> $timeFormat,
                ];
                $existSignal = GreenBeta::where('code', $code)->whereNull('close_time') ->orderBy('open_time', 'desc')->first();
                $existSignal->update($greenBeta);
            }
            if(in_array($signal[1],$signalOpen) ){
                $signalData = [
                    'code' => $code,
                    'signal_open'=> $signal[1],
                    'price_open'=> $signal[2],
                    'open_time'=> $timeFormat,
                ];

                GreenBeta::create($signalData);
            }
            return  ['status' => 'success', 'message' => 'Recived signal'];
        }
         // type =2 update 5p
        if($type ==3){

            $code = $codes[$signal[0]];
            $new_data = $signal[1];
            $key_cache = Cache::has($code);
            $cachedData = Cache::get($code);
            \Log::info('cachedData:'.$cachedData);
            if (!$key_cache) {
                $cachedData = Cache::get($code);
                // Nếu dữ liệu cũ khác thì cập nhật
                if ($cachedData != $new_data) {
                    Cache::forget($code); // Xóa cache cũ
                    Cache::put($code, $new_data, now()->endOfDay()); // Cập nhật cache mới
                }
            }else {
                Cache::put($code, $new_data, now()->endOfDay());
            }
            return  ['status' => 'success', 'message' => json_encode($request)];
        }

    }
}
