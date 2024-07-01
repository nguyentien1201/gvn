<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function getListSignalsFree()
    {
        $query = self::with('mstStock')->select();
        $data = $query->orderBy('id', 'desc')->get();
        $result = [];
        foreach ($data as $key => $value) {
            $group = Str::slug(strtolower($value->mstStock->group));
            $result[$group][] = [
                'code' => $value->mstStock->code,
                'last_sale' => $value->last_sale,
                'trend_price' => ConstantModel::TRENDING_PRICE[$value->trend_price],
                'date_action' => $value->date_action,
            ];
        }
        $limitedIndices = collect($result['indices-fut'])->take(8);
        $commodities = collect($result['commodities'])->take(8);
        $crypto = collect($result['crypto'])->take(8);
        $forex = collect($result['forex'])->take(8);

        return [
            'indices' => $limitedIndices,
            'commodities' => $commodities,
            'crypto' => $crypto,
            'forex' => $forex];
    }
}
