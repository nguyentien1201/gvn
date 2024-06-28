<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class MstStockGreen extends Model
{
    use SoftDeletes;

    public $table = 'mst_green_beta';
    protected $fillable = [
        'code','name', 'group'
    ];

    public function getListMstStockGreen(Request $request)
    {
        $query = self::select();
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }

    public function getSignalIds()
    {
        return MstStockGreen::pluck('id')->toArray();
    }
    public function getListMstStockGreenIds()
    {
        $query = self::select();
        return $query->orderBy('id', 'desc')->get();
    }
}
