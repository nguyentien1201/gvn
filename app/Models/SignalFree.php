<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class SignalFree extends Model
{
    use SoftDeletes;

    public $table = 'signal_free';

    protected $fillable = [
        'code', 'trend_price', 'last_sale', 'date_action'
    ];

    public function getListSignals(Request $request)
    {
        $query = self::with('mstStock')->select();
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }

    public function getSignalIds()
    {
        return SignalFree::pluck('id')->toArray();
    }
    public function mstStock()
{
    return $this->belongsTo('App\Models\MstStock', 'code');
}
}
