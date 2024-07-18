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

        return view('front.green_beta',compact('signals',
        'chart_data'));

    }
    public function greenAlpha(Request $request)
    {
        return view('front.green_alpha');
    }
    public function getHistorySignal($id)
    {
        $data = (new GreenBeta())->getSignalsById($id);
        $datacollect = collect($data);
        $profits = $datacollect->pluck('profit')->toArray();
        $sum = 0;
        $sumArray = [];
        foreach ($profits as $value) {
            $sum += $value; // Add current value to sum
            $sumArray[] = $sum; // Append sum to sumArray
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
