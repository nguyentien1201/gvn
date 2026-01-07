<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InvestmentFunds;
use DateTime;
class Investment extends Model
{
    use SoftDeletes;

    public $table = 'investments';
    protected $fillable = [
    'code','name','total_value','total_shares','avg_price','invest_date','current_price','current_profit_percent','take_profit_price','take_profit_percent','take_profit_expected','status',
        'created_at'
    ];
    public function getListInvestment()
    {
        $data = $this->orderBy('code', 'desc')->paginate(ConstantModel::$PAGINATION);
        return $data;
    }
    public function getListInvestmentFunding()
    {
        $data = $this->with('funds')->where('status','!=',3)->orderBy('code', 'desc')->limit(3)->get();
        return $data;
    }
   public function funds()
    {
        // 'investment_id' là tên cột khóa ngoại trên bảng 'investment_funds'
        return $this->hasMany(InvestmentFunds::class, 'investment_id')->orderBy('date', 'desc');;
    }
}
