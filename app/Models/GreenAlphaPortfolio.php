<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SignalFree;
use DB;
use Illuminate\Support\Str;
class GreenAlphaPortfolio extends Model
{

    public $table = 'green_alpha_portfolio';

    protected $fillable = [
        'month_year', 'profit', 'code_id','code','win_ratio','total_trade','version'
    ];
    public function getPortfolio($id){
        $data  = self::where('code_id',$id)->select('id','code_id',
        DB::raw("DATE_FORMAT(STR_TO_DATE(month_year, '%m/%Y'), '%Y-%m') as month_year"),
        'profit')->orderBy('month_year','desc')->get();
        return $data;

    }
    public function getListCode(){
        $data = $this->orderBy('code_id','asc')->groupBy('code_id')->select('id','code')->paginate(ConstantModel::$PAGINATION);
        return $data;
    }

}
