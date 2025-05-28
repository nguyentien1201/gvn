<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConstantModel;

class Subscription extends Model
{
    protected $fillable = ['user_id', 'product_id', 'start_date', 'end_date', 'price','is_trial'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getListSubscription()
    {
        $query = self::select();
        return $query->with(['user','product'])->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }
    public function getMySubscription()
    {

        $query = self::where('user_id', auth()->id())->select();
        return $query->with(['user','product'])->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }
}
