<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\GoogleDriveService;
use Carbon\Carbon;
use App\Models\CompanyInfo;
use App\Models\MaVnIndex;
use App\Models\SubGroupVnIndex;
use App\Models\GroupCapVnIndex;
use App\Models\SubGroupCapDetailVnIndex;
use Illuminate\Support\Facades\Cache;
use App\Models\StockSignalVnIndex;
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
        $data = $this->orderBy('code', 'asc')->paginate(ConstantModel::$PAGINATION);
        return $data;
    }

}
