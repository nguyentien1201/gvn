<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SignalFree;
use DB;
use Illuminate\Support\Str;
class GreenAlpha extends Model
{
    use SoftDeletes;

    public $table = 'green_alpha';

    protected $fillable = [
        'code', 'price_open', 'open_time', 'signal_close', 'price_close', 'price_cumulative_from', 'price_cumulative_to', 'profit', 'close_time', 'last_sale', 'signal_open'
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
    public function calculateProfitToday(){
        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();
        // Retrieve all GreenAlpha instances created today
        $todaysInstances = $this->whereBetween('open_time', [$todayStart, $todayEnd])->get();

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

        if(!empty($this->price_close) && $this->price_open > 0){
            if(   $type== 'buy'){
                $profit = ($this->price_close - $this->price_open)/$this->price_open * 100;
            }
            if( $type== 'sell'){
                $profit = ( $this->price_open - $this->price_close)/$this->price_open * 100;
            }

        }elseif($this->FreeSignal->last_sale > 0) {
            if($type== 'buy'){
                $profit = ($this->FreeSignal->last_sale - $this->price_open)/$this->price_open * 100;
            }
            if( $type== 'sell'){
                $profit = ( $this->price_open - $this->FreeSignal->last_sale)/$this->price_open * 100;
            }
        }
        return round($profit, 2);
    }
    public function getListSignalsByGroup()
    {
        $today = now()->toDateString();

// Query MstStock and load related Signal records with open_time of today
        $stocksAndSignals = MstStock::with(['AlphaSignal' => function($query) use ($today) {
            $query->whereDate('open_time', '=', $today)->orderBy('open_time', 'desc')
            ->select('*', DB::raw('count(*) as no_trading'),)->first();
        },'FreeSignal'])->get();

        foreach ($stocksAndSignals as $key => $value) {
            $signal = $value->AlphaSignal;
            if( empty($signal )) {
                $result[] =[
                        'code' => $value->code  ?? '',
                        'group' => $value->group ?? '',
                        'signal_open' =>'',
                        'price_open' => '',
                        'open_time' => '',
                        'last_sale' => '',
                        'profit' => '',
                        'signal_close' => '',
                        'price_close' => null,
                        'close_time' => '',
                        'id_code' => '',
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
                'last_sale' => $value->FreeSignal->last_sale  ?? '',
                'profit' => $signal->calculateProfit() ??'',
                'signal_close' => $signal->signal_close  ?? '',
                'price_close' => $signal->price_close > 0 ? $signal->price_close : null,
                'close_time' => $signal->close_time ?? '',
                'id_code' => $signal->code ?? '',
                'group' => $value->group ?? '',
                'profit_today'=> $signal->calculateProfitToday() ?? '',
                'no_trading'=> $signal->no_trading ?? '',
            ];
        }
        return $result;
    }
    public function FreeSignal()
    {
        return $this->belongsTo('App\Models\SignalFree', 'code','code');
    }
    public function getDataChartSignals(){
        $query = self::with('mstStock')
        ->whereNotNull('close_time') // Ensure price_close has a value
        ->groupBy('code') // Group the results by 'code'
        ->select('code',
            DB::raw('count(*) as total'),
            DB::raw('SUM(CASE WHEN profit > 0 THEN 1 ELSE 0 END) as profit_positive_count'),
            DB::raw('MIN(open_time) as start_trade'),
        );
        $data = $query->get();
        foreach ($data as $item) {
            if($item->mstStock){
                $item->code_name = $item->mstStock->code;
            }
            $item->win_ratio = round($item->profit_positive_count/$item->total * 100, 2);
        }
        return $data;
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
}
