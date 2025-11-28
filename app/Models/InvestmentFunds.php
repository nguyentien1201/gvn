<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\GoogleDriveService;
use Carbon\Carbon;
use App\Models\Investment;
use DateTime;
class InvestmentFunds extends Model
{

    public $table = 'investment_funds';
    protected $fillable = [
    'investment_id','contract_id','date','nav','note','created_at','updated_at'
    ];
    // public function getListInvestment()
    // {
    //     $data = $data = $this->select('investment_id','nav','note')->join('investments', 'investment_funds.investment_id', '=', 'investments.id')
    //          ->where('status','!=',2)->orderBy('investment_id', 'desc')->limit(3)->get();
    //     return $data;
    // }

}
