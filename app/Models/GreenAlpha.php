<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SignalFree;
use DB;
use Illuminate\Support\Str;
use App\Models\GreenAlphaPortfolio;
use App\Service\GoogleDriveService;
class GreenAlpha extends Model
{
    use SoftDeletes;

    public $table = 'green_alpha';

    protected $fillable = [
        'code', 'price_open', 'open_time', 'signal_close', 'price_close', 'price_cumulative_from', 'price_cumulative_to', 'profit', 'close_time', 'last_sale', 'signal_open',
        'total_trade','win_ratio','version'
    ];
        protected $casts = [
        'open_time' => 'date',
        'close_time' => 'date',
    ];
    public function getOpenTimeAttribute($value)
    {
        if(empty($value)){
            return null;
        }
        return Carbon::parse($value); // Customize the format as needed
    }
    public function getCloseTimeAttribute($value)
    {
        if(empty($value)){
            return null;
        }
        return Carbon::parse($value); // Customize the format as needed
    }

    public function getListSignals( Request $request)
    {
        $query = self::with('MstStock')->select();
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }

    public function getSignalIds()
    {
        return GreenBeta::pluck('id')->toArray();
    }
    public function MstStock()
    {
        return $this->belongsTo('App\Models\MstStock', 'code');
    }
    public function getListSignalsById($id, Request $request)
    {
        $id = (int) $id;
        $query = self::where('code',$id)->with('MstStock')->select();
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }
    public function calculateProfitToday($id){

        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();
        // Retrieve all GreenAlpha instances created today
        $todaysInstances = $this->whereBetween('close_time', [$todayStart, $todayEnd])->where('code',$id)->get();

        // Sum the profits for each instance
        $totalProfitToday = 0;
        foreach ($todaysInstances as $instance) {
            $profit = $instance->calculateProfit(); // Assuming calculateProfit returns a numeric value
            if (!is_null($profit)) { // Ensure that calculateProfit returned a valid number
                $totalProfitToday += $profit;
            }
        }

        return $totalProfitToday;
    }
    public function calculateProfit()
    {
        $profit = NULL;
        $type= strtolower($this->signal_open);
        if(!empty($this->profit)){
            return round($this->profit, 2);
        }
        if(!empty($this->price_close) && $this->price_open > 0){
            if(   $type== 'buy'){
                $profit = ($this->price_close - $this->price_open)/$this->price_open;
            }
            if( $type== 'sell'){
                $profit = ( $this->price_open - $this->price_close)/$this->price_open;
            }
        }
        return round($profit, 2);
    }
    public function getProfitAttribute()
    {

        $profit = NULL;
        $type= strtolower($this->signal_open);
        // if(!empty($this->profit)){
        //     return round($this->profit, 2);
        // }
        if(!empty($this->price_close) && $this->price_open > 0){

            if(   $type== 'buy'){
                $profit = ($this->price_close - $this->price_open)/$this->price_open *100;

            }
            if( $type== 'sell'){
                $profit = ( $this->price_open - $this->price_close)/$this->price_open *100;
            }
        }

        return round($profit, 2);
    }

    public function getListSignalsByGroup()
    {
        $today = Carbon::today()->toDateString();

// Query MstStock and load related Signal records with open_time of today
        $alphaStock = config('stock.green-alpha');
        $subQuery = GreenAlpha::select('code', DB::raw('MAX(open_time) as last_open_time'), DB::raw('count(*) as no_trading'))
        ->whereDate('open_time', '=', $today)
        ->groupBy('code');

        $stocksAndSignals = MstStock::with(['AlphaSignal' => function($query) use ($today,$subQuery) {
            $query->joinSub($subQuery, 'latest_signals', function($join) {
                $join->on('green_alpha.code', '=', 'latest_signals.code')
                     ->on('green_alpha.open_time', '=', 'latest_signals.last_open_time');
            })->select('*')
            ->groupBy('green_alpha.code');

        }])->whereIn('code',$alphaStock)->get();

        foreach ($stocksAndSignals as $key => $value) {

            $signal = $value->AlphaSignal;
            if( empty($signal )) {
                $result[] =[
                        'code' => $value->code  ?? '',
                        'group' => $value->group ?? '',
                        'signal_open' =>'',
                        'price_open' => '',
                        'open_time' => '',
                        'profit' => '',
                        'signal_close' => '',
                        'price_close' => null,
                        'close_time' => '',
                        'id_code' => $value->id,
                        'profit_today'=>'',
                        'no_trading'=>''
                    ];
                continue;
            }
            $result[] = [
                'signal_open' =>$signal->signal_open ?? '',
                'price_open' => $signal->price_open ?? '',
                'open_time' => $signal->open_time  ?? '',
                'code' => $value->code  ?? '',
                'profit' => $signal->calculateProfit() ??'',
                'signal_close' => $signal->signal_close  ?? '',
                'price_close' => $signal->price_close > 0 ? $signal->price_close : null,
                'close_time' => $signal->close_time ?? '',
                'id_code' => $signal->code ?? '',
                'group' => $value->group ?? '',
                'profit_today'=> $this->calculateProfitToday($signal->code) ?? '',
                'no_trading'=> $signal->no_trading ?? '',
            ];
        }
        return $result;
    }
    public function FreeSignal()
    {
        return $this->belongsTo('App\Models\SignalFree', 'code','code');
    }
    public function getListMstStockIds()
    {
        $alphaStock = config('stock.green-alpha');
        $stocksAndSignals = MstStock::with(['AlphaSignal'=> function($query){
            $query->select('*')->orderBy('total_trade','desc')->first();
        }])->whereIn('code',$alphaStock)->get();
        $dataSelect = [];
        foreach($stocksAndSignals as $key => $value){
            $dataSelect[$value->id] = [
                'id' => $value->id,
                'code' => $value->code,
                'win_ratio' => $value->AlphaSignal->win_ratio ?? null,
                'total_trade' => $value->AlphaSignal->total_trade ?? null
            ];
        }

        return $dataSelect;
    }

    public function getDataChartSignals($current_version='10.7.10'){
        $alphaStock = config('stock.green-alpha');
        $stocksAndSignals = MstStock::with(['AlphaSignal'=> function($query) use($current_version){
            $query->select('*')->where('version',$current_version)->orderBy('total_trade','desc')->first();
        }])->whereIn('code',$alphaStock)->orderBy('id','asc')->get();
        $dataSelect = [];
        foreach($stocksAndSignals as $key => $value){
            $dataSelect[$value->id] = [
                'id' => $value->id,
                'code' => $value->code,
                'win_ratio' => $value->AlphaSignal->win_ratio ?? null,
                'total_trade' => $value->AlphaSignal->total_trade ?? null
            ];
        }
        return collect( $dataSelect);
    }
    public function getSignalsById($id){
        $query = self::with('mstStock')
            ->where('code', $id)
            ->whereNotNull('close_time')->orderBy('close_time', 'desc')
            ->select();
        $data = $query->get();
        $result = [];
        foreach ($data as $item) {
            if($item->mstStock){
                $item->code_name = $item->mstStock->code;
            }
            $result[] = [
                'signal_open' =>$item->signal_open,
                'price_open' => $item->price_open,
                'open_time' => $item->open_time,
                'price_better_buy' =>'',
                'code' => $item->mstStock->code,
                'last_sale' => $item->last_sale,
                'profit' => $item->calculateProfit(),
                'signal_close' => $item->signal_close,
                'price_close' => $item->price_close,
                'close_time' => $item->close_time,
                'id_code' => $item->code,
            ];
        }
        return $result;
    }
    public function getHistorySignal($id){
        $query = self::with('mstStock')
            ->where('code', $id)
            ->whereNotNull('close_time')->orderBy('close_time', 'desc')
            ->select();
        $data = $query->get();
        $result = [];
        foreach ($data as $item) {
            if($item->mstStock){
                $item->code_name = $item->mstStock->code;
            }
            $result[] = [
                'signal_open' =>$item->signal_open,
                'price_open' => $item->price_open,
                'open_time' => $item->open_time,
                'price_better_buy' =>'',
                'code' => $item->mstStock->code,
                'last_sale' => $item->last_sale,
                'profit' => $item->calculateProfit(),
                'signal_close' => $item->signal_close,
                'price_close' => $item->price_close,
                'close_time' => $item->close_time,
                'id_code' => $item->code,
            ];
        }

        return $result;
    }

    public function getMonthlyProfitSum($id){
        $results = DB::table('green_beta') // Assuming 'green_beta' is the table name
            ->select(
                DB::raw('MAX(price_close) as max_price'),
                DB::raw('MIN(price_open) as min_price'),
                DB::raw('YEAR(close_time) as year'),
                DB::raw('MONTH(close_time) as month'),
                DB::raw('SUM(profit) as total_profit')
            )->where('code','=', $id)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $formattedResults = [];
        foreach ($results as $result) {
            $formattedResults[] = [
                'year' => $result->year,
                'month' => $result->month,
                'label' => $result->month.'-'. $result->year,
                'total_profit' => $result->total_profit,
                'profit' => $result->total_profit/$result->max_price * 100,
                'max_price' => $result->max_price,
                'min_price' => $result->min_price,
            ];
        }
        return $formattedResults;
    }
    public function getProfitByMonth($id){
        $current_version= config('config.current_version');
        $stocksAndSignals = GreenAlphaPortfolio::where('code_id',$id)->where('version',$current_version)->orderBy('month_year','asc')->select('profit',
        DB::raw('STR_TO_DATE(month_year, "%m/%Y") as month_year')
        )->get();
        foreach ($stocksAndSignals as $item) {
            $item->profit = round($item->profit * 100, 2);
        }
        return $stocksAndSignals;
    }
    public function getCurrentYearProfitSum()
    {
        $current_version= config('config.current_version');
        $profit = GreenAlphaPortfolio::select('code_id','month_year','profit','code')->where('version',$current_version)->orderBy('code_id','asc')->orderBy('month_year','desc')->get();
        // Get the current year
        $currentYear = date('Y');

        $currentYearProfits = $profit->filter(function($item) use ($currentYear) {
            return strpos($item['month_year'], $currentYear) !== false;
        });
        $groupedByCode = $currentYearProfits->groupBy('code');

        $sumProfitYear = [];
        $sumMonth = [];
        $lable = [];
        foreach ($groupedByCode as $key => $value) {
            $sum = 1;
            $lable[] = $key;
            foreach ($value as $i => $item) {
                if($i==0) {
                    $sumMonth[] =round(($item['profit']*100 ?? 0) ,2) ;
                }
                $sum = $sum + $sum*($item['profit'] ?? 0);

            }
            $sumProfitYear[] = round($sum,2);
        }
        $result = [
            'lable'=>$lable,
            'profitMonth' => $sumMonth,
            'profitYear' => $sumProfitYear
        ];
        return $result;
    }
    public function importByDrive(){
        $codes = MstStock::pluck('id','code')->toArray();
        $this->googleDriveService = new GoogleDriveService();
        $fileUrl = config('drivefile.drivefile.nas100');
        $alphas = $this->googleDriveService->getSheetData($fileUrl, 'Alpha!A1:H');
        array_shift($alphas);
        $current_version = config('config.current_version');
        foreach($alphas as $item){
            if(empty($item[0])) continue;
            try {
                $greenAlpha = [
                    'code' => $codes[$item[0]],
                    'signal_open' => $item[1],
                    'price_open' => (float)$item[2],
                    'open_time' =>!empty($item[3]) ? Carbon::createFromFormat('d/m/Y H:i', $item[3])->format('Y-m-d H:i:s') : null,
                    'close_time' => !empty($item[6])  ? Carbon::createFromFormat('d/m/Y H:i', $item[6])->format('Y-m-d H:i:s') : null,
                    'signal_close' => $item[4] ?? null,
                    'price_close' =>!empty($item[5]) ? (float)$item[5] : null,
                    'profit' =>!empty($item[7]) ? (float)$item[7] : null,
                    'version'=>$current_version

                ];
                $existingRecord = GreenAlpha::where(['code'=>$greenAlpha['code'],'price_open'=>$greenAlpha['price_open'],'open_time'=> $greenAlpha['open_time']] )->first();

                if ($existingRecord) {
                    $existingRecord->update($greenAlpha);
                } else {
                    // Record does not exist, insert new
                    GreenAlpha::create($greenAlpha);
                }
                } catch (\Exception $e) {
                    continue;
                }
    }
}
public function getCurrentMonthProfitSum($current_version='10.7.10')
    {

        $profitMonth = GreenAlpha::with('mstStock')->where('version',$current_version)->whereBetween('close_time', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orderBy('code','asc')->get();

        $groupedByCode = $profitMonth->groupBy('code');

        $sumMonth = [];
        $sumWeek = [];
        $lable = [];
        foreach ($groupedByCode as $key => $value) {

            $sum = 0;
            $sumweek=0;

            foreach ($value as $i => $item) {
                if($i == 0) {
                    $lable[] = $item->mstStock->code;
                  };
                if(Carbon::now()->startOfWeek() <= $item->close_time && $item->close_time <= Carbon::now()->endOfWeek()){
                    $sumweek += $item->calculateProfit() ?? 0;
                }
                $sum += $item->calculateProfit() ?? 0;
            }
            $sumWeek[] = round($sumweek,2);
            $sumMonth[] = round($sum,2);
        }

        $result = [
            'lable'=>$lable,
            'profitWeek' => $sumWeek,
            'profitMonth' => $sumMonth
        ];
        return $result;
    }
    public function getListSignalsByGroupMonth()
{
    $today = Carbon::today()->toDateString();
    $currentMonth = Carbon::now()->format('m');  // Lấy tháng hiện tại
    $currentYear = Carbon::now()->format('Y');  // Lấy năm hiện tại

    // Query MstStock và load các bản ghi Signal liên quan với open_time trong tháng hiện tại
    $alphaStock = config('stock.green-alpha');
    $subQuery = GreenAlpha::select('code',
                    DB::raw('MONTH(open_time) as month'),
                    DB::raw('YEAR(open_time) as year'),
                    DB::raw('SUM(profit) as total_profit'),  // Tính tổng lợi nhuận theo tháng
                    DB::raw('MAX(open_time) as last_open_time'),
                    DB::raw('count(*) as no_trading'))
                    ->whereMonth('open_time', $currentMonth)  // Lọc theo tháng hiện tại
                    ->whereYear('open_time', $currentYear)  // Lọc theo năm hiện tại
                    ->groupBy('code', 'month', 'year');

    $stocksAndSignals = MstStock::with(['AlphaSignal' => function($query) use ($today, $subQuery) {
        $query->joinSub($subQuery, 'latest_signals', function($join) {
            $join->on('green_alpha.code', '=', 'latest_signals.code')
                 ->on('green_alpha.open_time', '=', 'latest_signals.last_open_time');
        })
        ->select('*')
        ->groupBy('green_alpha.code');
    }])->whereIn('code', $alphaStock)->get();

    $result = [];
    foreach ($stocksAndSignals as $key => $value) {
        $signal = $value->AlphaSignal;
        if (empty($signal)) {
            $result[] = [
                'code' => $value->code ?? '',
                'group' => $value->group ?? '',
                'signal_open' => '',
                'price_open' => '',
                'open_time' => '',
                'profit' => '',
                'signal_close' => '',
                'price_close' => null,
                'close_time' => '',
                'id_code' => $value->id,
                'profit_month' => '',
                'no_trading' => ''
            ];
            continue;
        }

        // Cập nhật kết quả, tổng lợi nhuận theo tháng
        $result[] = [
            'signal_open' => $signal->signal_open ?? '',
            'price_open' => $signal->price_open ?? '',
            'open_time' => $signal->open_time ?? '',
            'code' => $value->code ?? '',
            'profit' => $signal->total_profit ?? '',  // Tổng lợi nhuận của tháng
            'signal_close' => $signal->signal_close ?? '',
            'price_close' => $signal->price_close > 0 ? $signal->price_close : null,
            'close_time' => $signal->close_time ?? '',
            'id_code' => $signal->code ?? '',
            'group' => $value->group ?? '',
            'profit_month' => $this->calculateProfitByMonth($signal->code) ?? '',
            'no_trading' => $signal->no_trading ?? '',
        ];
    }

    return $result;
}
public function calculateProfitByMonth($id){

    $todayStart = now()->startOfMonth();
    $todayEnd = now()->endOfMonth();
    // Retrieve all GreenAlpha instances created today
    $todaysInstances = $this->whereBetween('close_time', [$todayStart, $todayEnd])->where('code',$id)->get();

    // Sum the profits for each instance
    $totalProfitToday = 0;
    foreach ($todaysInstances as $instance) {
        $profit = $instance->calculateProfit(); // Assuming calculateProfit returns a numeric value
        if (!is_null($profit)) { // Ensure that calculateProfit returned a valid number
            $totalProfitToday += $profit;
        }
    }

    return $totalProfitToday;
}

}
