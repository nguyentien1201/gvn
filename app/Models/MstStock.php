<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MstStock extends Model
{
    use SoftDeletes;

    public $table = 'mst_stocks';
    protected $fillable = [
        'code','name', 'group'
    ];

    public function getListMstStock(Request $request)
    {
        $query = self::select();
        return $query->orderBy('group', 'desc')->paginate(ConstantModel::$PAGINATION);
    }

    public function getSignalIds()
    {
        return MstStock::pluck('id')->toArray();
    }
    public function getListMstStockIds()
    {
        $query = self::select();
        return $query->orderBy('id', 'desc')->get();
    }
    public function getListMstStockIdsAlpha()
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

    public function getListMstStockNotIn()
    {
        $usedStockIds = SignalFree::pluck('code')->toArray();
        $query = self::select();
        $query->whereNotIn('id', $usedStockIds);
        return $query->orderBy('id', 'desc')->get();
    }
    public function AlphaSignal()
    {
        return $this->belongsTo('App\Models\GreenAlpha', 'id','code');
    }
    public function FreeSignal()
    {
        return $this->belongsTo('App\Models\SignalFree', 'id','code');
    }
}
