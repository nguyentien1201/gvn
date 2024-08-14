<?php


namespace App\Http\Controllers\Front;


use App\Models\GreenBeta;
use Illuminate\Support\Facades\Request;
use App\Models\SignalFree;
use App\Models\MstStock;
use App\Models\GreenAlpha;
use App\Models\GreenStockNas100;
use DB;
class HomeController
{
    public function index(Request $request)
    {

        $signals = (new GreenBeta())->getListSignalsByGroup();

        if(!\Auth::check()){
            foreach ($signals as $key => $value) {
                $value['open_time'] = 'fas fa-lock';
                $value['price_open'] = 'fas fa-lock';
                $signals[$key] = $value;
            }
        }
        $nas100 = $this->getHistorySignal(1);
        $eth = $this->getHistorySignal(23);
        $usOil = $this->getHistorySignal(15);
        $xausud = $this->getHistorySignal(13);
        $default_chart['nas100'] = $nas100['data'];
        $default_chart['eth'] = $eth['data'];
        $default_chart['usOil'] = $usOil['data'];
        $default_chart['xausud'] = $xausud['data'];
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
        return view('front.home',compact('signals','favorite','last_signal','default_chart'));
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
        $signals = (new GreenAlpha())->getListSignalsByGroup();

        $data_chart = (new GreenAlpha())->getDataChartSignals();
        $dataChartProfit = (new GreenAlpha())->getCurrentYearProfitSum();
        $data_chart_default = $this->getHistoryAlphaSignal(1);
        // dd($data_chart_default);
        $code = $data_chart->pluck('code')->toArray();
        $total = $data_chart->pluck('total_trade')->toArray();
        $winratio = $data_chart->pluck('win_ratio')->toArray();
        // $startDate = $data_chart->pluck('start_trade')->toArray();
        $chart_data = [
            'code' => $code,
            'total' => $total,
            'winratio' => $winratio,
            // 'startDate' => $startDate
        ];

        return view('front.green_alpha',compact('signals',
        'chart_data','dataChartProfit','data_chart_default'));
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
    public function getHistoryAlphaSignal($id)
    {
        $profitByMonth = (new GreenAlpha())->getProfitByMonth($id);
        $labels = $profitByMonth->pluck('month_year')->toArray();
        $profitMonth = [
            'profit' => $profitByMonth->pluck('profit')->toArray(),
        ];
        $labels = array_map(function($value) {
            return str_replace('-00', '', $value);
        }, $labels);
        $profitMonth['lable'] = $labels;
        $data = (new GreenAlpha())->getHistorySignal($id);

        $dataSort =$data ;
        usort($dataSort, function($a, $b) {
            return  strtotime($a['open_time'])-strtotime($b['open_time']);
        });
        $datacollect = collect($dataSort);

        $profits = $profitMonth['profit'];
        $sum = 100;
        $sumArray = [];
        foreach ($profits as $value) {
            $sum = $sum + $sum*$value/100;
            $sumArray[] = round($sum,2);
        }
        $result = [
            'list' => $data,
            'profit' => $sumArray,
            'profitByMonth' => $profitMonth
        ];
        return [
            'status' => 200,
            'data' => $result
        ];
    }
    public function greenStock(){
        $signals = (new GreenStockNas100())->getListNas100Api();

        return view('front.green_stock',compact('signals'));
    }
}
