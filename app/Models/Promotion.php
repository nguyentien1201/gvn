<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Promotion extends Model
{
    use SoftDeletes;

    public $table = 'promotions';

    protected $fillable = [
        'title', 'message', 'execution_time', 'status'
    ];

    public function getList(Request $request)
    {
        $query = self::select();
        if ($request->title) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if (isset($request->status) && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($request->start_time) {
            $query->where('execution_time', '>=', date('Y-m-d H:i:s', strtotime($request->start_time)));
        }
        if ($request->end_time) {
            $query->where('execution_time', '<=', date('Y-m-d H:i:s', strtotime($request->end_time)));
        }
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }

    public function getRunPromotion($currentTime)
    {
        return self::select('promotions.*', 'pi.id as promotion_customer_id', 'pi.customer_id', 'c.first_name', 'c.last_name', 'c.phone_number', 'c.email', 'c.address', 'c.note')
            ->where('execution_time', 'LIKE', '%' . $currentTime . '%')
            ->where('promotions.status', ConstantModel::PROMOTION_STATUS['reserve'])
            ->rightJoin('promotion_items as pi', 'pi.promotion_id', 'promotions.id')
            ->join('customers as c', 'c.id', 'pi.customer_id')
            ->get();
    }

    public function updateStatusByIds($ids)
    {
        return self::whereIn('id', $ids)
            ->update([
                'status' => ConstantModel::PROMOTION_STATUS['done']
            ]);
    }
}
