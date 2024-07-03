<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GreenBeta extends Model
{
    use SoftDeletes;

    public $table = 'green_beta';

    protected $fillable = [
        'code', 'price_open', 'open_time', 'signal_close', 'price_close', 'price_cumulative_from', 'price_cumulative_to', 'profit', 'close_time', 'last_sale', 'signal_open'
    ];
        protected $casts = [
        'open_time' => 'date',
    ];
    public function getOpenTimeAttribute($value)
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
}
