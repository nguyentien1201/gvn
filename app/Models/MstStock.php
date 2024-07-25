<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

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
