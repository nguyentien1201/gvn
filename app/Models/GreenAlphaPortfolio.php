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
        'month_year', 'profit', 'code_id','code'
    ];


}
