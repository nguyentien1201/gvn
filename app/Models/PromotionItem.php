<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PromotionItem extends Model
{
    use SoftDeletes;

    public $table = 'promotion_items';

    protected $fillable = [
        'promotion_id', 'customer_id', 'status', 'send_time'
    ];

    public function getCustomerIdsByPromotionId($promotionId)
    {
        return self::where('promotion_id', $promotionId)->pluck('customer_id')->toArray();
    }

    public function isSelectAllCustomer($promotionId)
    {
        return self::where('promotion_id', $promotionId)->where('customer_id', 0)->exists();// 0 is all customer
    }

    public function getCnt($promotionId)
    {
        return self::select(DB::raw('COUNT(id) as total'),
            DB::raw('COUNT(if(status = 1, id, NULL)) as sent'))
            ->where('promotion_id', $promotionId)
            ->first();
    }

    public function updatePromotionItem($id)
    {
        return self::where('id', $id)
            ->update([
                'send_time' => date('Y-m-d H:i:s'),
                'status' => ConstantModel::PROMOTION_STATUS['done']
            ]);
    }
}
