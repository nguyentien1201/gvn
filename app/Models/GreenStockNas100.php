<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\GoogleDriveService;
use Carbon\Carbon;
use App\Models\CompanyInfo;
use App\Models\Ma;
use App\Models\SubGroup;
use App\Models\GroupCap;
use App\Models\SubGroupCapDetail;
use Illuminate\Support\Facades\Cache;
class GreenStockNas100 extends Model
{
    use SoftDeletes;
    protected $googleDriveService;
    public $table = 'greenstock_nas100';
    protected $fillable = [
        'rating',
        'code',
        'point',
        'price',
        'current_price',
        'trending',
        'signal',
        'profit',
        'post_sale_discount',
        'time',
        'created_at'
    ];
    public function getListNas100()
    {
        $data = $this->orderBy('rating', 'asc')->paginate(ConstantModel::$PAGINATION);
        return $data;
    }
    public function import($isCompany = false)
    {
        $this->googleDriveService = new GoogleDriveService();
        $fileUrl = config('drivefile.drivefile.nas100');

        $subGroupCapDetail = new SubGroupCapDetail();
        $isCompany = true;
        if ($isCompany == true) {
            $company = $this->googleDriveService->getSheetData($fileUrl, 'Tên doanh nghiệp!A1:C');
            array_shift($company);
            foreach ($company as $item) {
                $company = [
                    'code' => $item[0],
                    'company_name' => $item[1],
                    'industry' => $item[2] ?? null,
                ];
                $companyInfo = CompanyInfo::where('code', $company['code'])->first();

                if ($companyInfo) {
                    $companyInfo->update($company);

                } else {
                    CompanyInfo::create($company);
                }
            }
        }
        $fileContent = $this->googleDriveService->getFile($fileUrl);

        $listData = explode("\r\n", $fileContent);

        array_shift($listData);
        $header = $listData[0] ?? [];
        $header = explode(",", $header);

        array_shift($listData);
        // \Log::info($listData);

        foreach ($listData as $index=> $item) {
            try {

                $greenstock_nas100 = [];
                $item = explode(",", $item);
                if($index ==0 ){
                    Cache::put('nas100_win', $item[37]);
                    Cache::put('nas100_loss', $item[38]);
                }
                foreach ($item as $key => $value) {
                    if ($key < 44) continue;
                    if(empty($header[$key])) continue;
                    $date =Carbon::createFromFormat('d/m/y', $header[$key])->format('Y-m-d') ?? null;
                    if(empty($date)) continue;
                    $subgroupcap = [
                        'group_name' => $item[43] ?? '',
                        'avg_cap' => (float) $value,
                        'date' => $date,
                    ];
                    $subgroup = SubGroupCapDetail::where('group_name', $subgroupcap['group_name'])->where('date', $subgroupcap['date'])->first();
                    if($subgroup){
                        $subgroup->update($subgroupcap);
                    }else{
                        SubGroupCapDetail::create($subgroupcap);
                    }
                }
                if (!empty($item[17]) && !empty($item[14]) && !empty($item[15]) && !empty($item[16]) && !empty($item[18]) && !empty($item[19])) {
                    $ma = [
                        'time' => Carbon::createFromFormat('d/m/y', $item[14])->format('Y-m-d') ?? null,
                        'nas100' => (float) $item[15],
                        'upMA50' => (float) $item[16],
                        'downMA50' => (float) $item[17],
                        'upMA200' => (float) $item[18],
                        'downMA200' => (float) $item[19],
                    ];

                    $maData = Ma::where('time', $ma['time'])->first();

                    if ($maData) {

                        $maData->update($ma);
                    } else {
                        Ma::create($ma);
                    }
                }
                $transaction_Portfolio = [
                        'time' => Carbon::createFromFormat('d/m/y', $item[14])->format('Y-m-d') ?? null,
                        'buy' => (int) $item[20],
                        'hold' => (int) $item[21],
                        'sell' => (int) $item[22],
                        'cash' => (int) $item[23],
                    ];

                    $portfolio = TransactionPortfolioNas100::where('time', $transaction_Portfolio['time'])->first();

                    if ($portfolio) {

                        $portfolio->update($transaction_Portfolio);
                    } else {
                        TransactionPortfolioNas100::create($transaction_Portfolio);
                    }
                if (!empty($item[11])) {
                    $subgroups = [
                        'group_name' => $item[11] ?? '',
                        'previous_session' => (float) $item[12],

                    ];

                    $subgroup = SubGroup::where('group_name', $subgroups['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups);
                    } else {
                        SubGroup::create($subgroups);
                    }
                }
                if (!empty($item[25])) {
                    $subgroups_year = [
                        'group_name' => $item[25] ?? '',
                        'current_year' => (float) $item[26],
                    ];
                    $subgroup = SubGroup::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroup::create($subgroups_year);
                    }
                }
                if (!empty($item[28])) {
                    $subgroups_year = [
                        'group_name' => $item[28] ?? '',
                        'quarter' => (float) $item[29],
                    ];
                    $subgroup = SubGroup::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroup::create($subgroups_year);
                    }
                }
                if (!empty($item[31])) {
                    $subgroups_year = [
                        'group_name' => $item[31] ?? '',
                        'current_month' => (float)$item[32],
                    ];
                    $subgroup = SubGroup::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroup::create($subgroups_year);
                    }
                }
                if (!empty($item[40])) {
                    $subgroups_year = [
                        'group_name' => $item[40] ?? '',
                        'avg_cap' => (float) $item[41],
                    ];
                    $subgroup = SubGroup::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroup::create($subgroups_year);
                    }
                }
                if (!empty($item[34])) {
                    $group_cap = [
                        'group' => $item[34] ?? '',
                        'avg_day' => (float) $item[35],
                    ];
                    $cap = GroupCap::where('group', $group_cap['group'])->first();
                    if ($cap) {
                        $cap->update($group_cap);
                    } else {
                        GroupCap::create($group_cap);
                    }
                }
                if(!empty($item[0])){
                    $greenstock_nas100 = [
                        'rating' => (int) $item[0],
                        'code' => $item[1],
                        'point' => (int) $item[2],
                        'current_price' => (float) $item[5],
                        'trending' => $item[3],
                        'signal' => $item[4],
                        'profit' => (float) $item[6],
                        'post_sale_discount' => !empty($item[7]) ? (float) $item[7] : null,
                        'price' => round((float) $item[8], 2),
                        'time' => Carbon::createFromFormat('d/m/y', $item[9])->format('Y-m-d') ?? null,
                    ];
                    $nas100 = self::where('code', $greenstock_nas100['code'])->first();
                    if ($nas100) {
                        $nas100->update($greenstock_nas100);
                    } else {
                        self::create($greenstock_nas100);
                    }
                }

            } catch (\Exception $e) {
                \Log::info($e->getMessage());
                return redirect()->route('admin.nas100.index')->with('error', __('panel.error'));
            }
        }
        return redirect()->route('admin.nas100.index')->with('success', __('panel.success'));
    }
    public function getListNas100Api($limit = 200)
    {
        $getData = $this->with('companyInfo');
        $data = $getData->orderBy('rating', 'asc')->limit($limit)->get();
        $list_code = $getData->orderBy('code', 'asc');
        $data = $data->map(function ($item) {
            if ($item->companyInfo) {
                $item['company_name'] = $item->companyInfo->company_name;
            }
            return $item;
        });

        return [
            'list_code'=>$list_code,
            'data'=>$data
        ];
    }
    public function companyInfo()
    {
        return $this->belongsTo(CompanyInfo::class, 'code', 'code');
    }
    public function getTopStock()
    {
        $data =  $this->orderBy('profit', 'desc')->limit(5)->get();
        $data = $data->map(function ($item) {
            if ($item->companyInfo) {
                $item['company_name'] = $item->companyInfo->company_name;
            }
            return $item;
        });
        return $data;
    }
    public function getGroupSignal()
    {
        return $this->select('signal', \DB::raw('count(*) as total'))
            ->groupBy('signal')
            ->get()->toArray();
    }
     public function getGroupSignalV2()
    {
        $data = $this->select('signal', \DB::raw('count(*) as total'))
        ->groupBy('signal')
            ->get()
            ->toArray();

        // Đảm bảo đủ 4 loại signal cố định
        $signals = ['CASH', 'HOLD', 'BUY', 'SELL'];
        $result = [];

        // Convert $data thành map [signal => total]
        $map = collect($data)->pluck('total','signal')->toArray();

        foreach ($signals as $sig) {
            $result[] = [
                'signal' => $sig,
                'total'  => $map[$sig] ?? 0
            ];
        }

        return $result;
    }
    public function getTopStockByGroup($group)
    {
        $listStock =  CompanyInfo::where('industry', $group)->get()->pluck('code')->toArray();
        $data =  $this->whereIn('code', $listStock)->orderBy('point', 'desc')->limit(5)->get();
        $data = $data->map(function ($item) {
            if ($item->companyInfo) {
                $item['company_name'] = $item->companyInfo->company_name;
            }
            return $item;
        });
        return $data;
    }


}
