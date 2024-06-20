<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Signal extends Model
{
    use SoftDeletes;

    public $table = 'signals';

    protected $fillable = [
        'code', 'price_current', 'trend', 'signal', 'price_action', 'price_cumulative_from', 'price_cumulative_to', 'price_stoploss', 'price_target', 'profit', 'description', 'date_action'
    ];

    public function getListSignals(Request $request)
    {
        $query = self::with('mstStock')->select();
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }

    public function getSignalIds()
    {
        return Signal::pluck('id')->toArray();
    }
    public function mstStock()
{
    return $this->belongsTo('App\Models\MstStock', 'code');
}
}
