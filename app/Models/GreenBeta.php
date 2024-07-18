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
        return Carbon::parse($value)->format('d-m-Y'); // Customize the format as needed
    }
    public function getCloseTimeAttribute($value)
    {
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
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }
    public function calculateProfit()
    {
        $profit = NULL;
        if(!empty($this->price_close)){
            $profit = ($this->price_close - $this->price_open)/$this->price_open * 100;
        }elseif($this->last_sale > 0) {
            $profit = ($this->last_sale - $this->price_open)/$this->price_open * 100;
        }
        return round($profit, 2);
    }
    public function getListSignalsByGroup()
    {
        // # GreenBeta::select('*', DB::raw('MAX(updated_at) as updated_at'))->whereIn('code',$stocks)->with(['MstStock'])->groupBy('code')->orderBy('updated_at', 'desc')->get();
        $query = self::with(['FreeSignal','mstStock'])->groupBy('code')->orderBy('updated_at', 'desc')->select('*', DB::raw('MAX(updated_at) as updated_at'));
        $data = $query->orderBy('id', 'desc')->get();
        $result = [];
        foreach ($data as $key => $value) {

            $group = Str::slug(strtolower($value->mstStock->group));

            $result[$group][] = [
                'signal_open' =>$value->signal_open,
                'price_open' => $value->price_open,
                'open_time' => $value->open_time,
                'trend_price' => ConstantModel::TRENDING_PRICE[$value->FreeSignal->trend_price] ?? '',
                'price_better_buy' =>'',
                'code' => $value->mstStock->code,
                'last_sale' => $value->last_sale,
                'profit' => $value->calculateProfit(),
                'signal_close' => $value->signal_close,
                'price_close' => $value->price_close,
                'close_time' => $value->close_time,
            ];
        }

        $limitedIndices = collect($result['indices-fut']?? []);
        $commodities = collect($result['commodities']?? []);
        $crypto = collect($result['crypto']?? []);
        $forex = collect($result['forex'] ?? []);

        return [
            'indices' => $limitedIndices,
            'commodities' => $commodities,
            'crypto' => $crypto,
            'forex' => $forex];
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
}
