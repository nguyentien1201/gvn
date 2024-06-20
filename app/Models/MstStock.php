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
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
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
}
