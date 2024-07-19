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
    public function greenBeta(Request $request)
    {
        $signals = (new GreenBeta())->getListSignalsByGroup();

        $data_chart = (new GreenBeta())->getDataChartSignals();
        $code = $data_chart->pluck('code_name')->toArray();
        $total = $data_chart->pluck('total')->toArray();
        $winratio = $data_chart->pluck('win_ratio')->toArray();
        $startDate = $data_chart->pluck('start_trade')->toArray();
        $chart_data = [
            'code' => $code,
            'total' => $total,
            'winratio' => $winratio,
            'startDate' => $startDate
        ];
        $nas100 = $this->getHistorySignal(1);
        $default_chart = $nas100['data'];
        return view('front.green_beta',compact('signals',
        'chart_data','default_chart'));

    }
    public function greenAlpha(Request $request)
    {
        return view('front.green_alpha');
    }
    public function getHistorySignal($id)
    {
        $data = (new GreenBeta())->getSignalsById($id);
        $dataSort =$data ;
        usort($dataSort, function($a, $b) {
        return  strtotime($a['close_time'])-strtotime($b['close_time']);
    });
        $datacollect = collect($dataSort);
        $profits = $datacollect->pluck('profit')->toArray();
        $sum = 100;
        $sumArray = [];
        foreach ($profits as $value) {
            $sum = $sum + $sum*$value/100;
            $sumArray[] = round($sum,2);
        }
        $result = [
            'list' => $data,
            'profit' => $sumArray
        ];

        return [
            'status' => 200,
            'data' => $result
        ];
    }
}
