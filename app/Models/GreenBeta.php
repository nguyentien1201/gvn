<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SignalFree;
use DB;
use Illuminate\Support\Str;
class GreenBeta extends Model
{
    use SoftDeletes;

    public $table = 'green_beta';

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
        return Carbon::parse($value)->format('d-m-Y'); // Customize the format as needed
    }
    public function getCloseTimeAttribute($value)
    {
        if(empty($value)){
            return null;
        }
        return Carbon::parse($value)->format('d-m-Y'); // Customize the format as needed
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
        return $query->orderBy('open_time', 'desc')->paginate(ConstantModel::$PAGINATION);
    }
    public function calculateProfit()
    {
        $profit = NULL;
        if(!empty($this->price_close) && $this->price_open > 0){
            $profit = ($this->price_close - $this->price_open)/$this->price_open * 100;
        }elseif($this->FreeSignal->last_sale > 0) {
            $profit = ($this->FreeSignal->last_sale - $this->price_open)/$this->price_open * 100;
        }
        return round($profit, 2);
    }
    public function getListSignalsByGroup()
    {
        // GreenBeta::select('*', DB::raw('MAX(updated_at) as updated_at'))->whereIn('code',$stocks)->with(['MstStock'])->groupBy('code')->orderBy('updated_at', 'desc')->get();
        // $query = self::with(['FreeSignal','mstStock'])->groupBy('code')->select('*', DB::raw('MAX(open_time) as sort_time'));
        // $data = $query->get();
        $latestTimesSubQuery = self::select('code', DB::raw('MAX(open_time) as latest_open_time'))
        ->groupBy('code');
            $query = self::joinSub($latestTimesSubQuery, 'latest_times', function ($join) {
            $join->on('green_beta.code', '=', 'latest_times.code')
            ->on('green_beta.open_time', '=', 'latest_times.latest_open_time');
            })
            ->with(['FreeSignal', 'mstStock'])
            ->select('green_beta.*') // Adjust 'green_beta.*' if you need specific columns
            ->orderBy('green_beta.code') // Ensure a consistent order by code
            ->orderBy('green_beta.id', 'desc'); // Use ID to break ties, assuming newer records have higher IDs
        $data = $query->get();
        $result = [];
        foreach ($data as $key => $value) {
            $result[] = [
                'signal_open' =>$value->signal_open,
                'price_open' => $value->price_open,
                'open_time' => $value->open_time,
                'trend_price' => ConstantModel::TRENDING_PRICE[$value->FreeSignal->trend_price] ?? '',
                'price_better_buy' =>'',
                'code' => $value->mstStock->code,
                'last_sale' => $value->FreeSignal->last_sale,
                'profit' => $value->calculateProfit(),
                'signal_close' => $value->signal_close,
                'price_close' => $value->price_close > 0 ? $value->price_close : null,
                'close_time' => $value->close_time,
                'id_code' => $value->code,
                'group' => $value->mstStock->group,
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
}
