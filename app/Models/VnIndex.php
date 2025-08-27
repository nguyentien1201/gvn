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
class VnIndex extends Model
{
    use SoftDeletes;
    protected $googleDriveService;
    public $table = 'greenstock_vnindex';
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
    public function getListVnIndex()
    {
        $data = $this->orderBy('rating', 'asc')->paginate(ConstantModel::$PAGINATION);
        return $data;
    }
    public function import($isCompany = false)
    {
        $this->googleDriveService = new GoogleDriveService();
        $fileUrl = config('drivefile.drivefile.nas100');
        $subGroupCapDetail = new SubGroupCapDetailVnIndex();
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
        $fileContent =$this->googleDriveService->getSheetData($fileUrl, 'Stock-VNindex!A2:AX');
        //  $this->googleDriveService->getFile($fileUrl);

        $listData =  $fileContent;

        $header = $listData[0] ?? [];
        array_shift($listData);

        foreach ($listData as $index => $item) {
            try {
                $greenstock_nas100 = [];
                if($index ==0 ){
                    Cache::put('vnindex_win', $item[33]);
                    Cache::put('vnindex_loss', $item[34]);
                }
                foreach ($item as $key => $value) {
                    if ($key < 40) continue;
                    if(empty($header[$key])) continue;
                    $date =Carbon::createFromFormat('d/m/y', $header[$key])->format('Y-m-d') ?? null;
                    if(empty($date)) continue;
                    $subgroupcap = [
                        'group_name' => $item[39] ?? '',
                        'avg_cap' => (float) $value,
                        'date' => $date,
                    ];
                    $subgroup = SubGroupCapDetailVnIndex::where('group_name', $subgroupcap['group_name'])->where('date', $subgroupcap['date'])->first();
                    if($subgroup){
                        $subgroup->update($subgroupcap);
                    }else{
                        SubGroupCapDetailVnIndex::create($subgroupcap);
                    }
                }
                if (!empty($item[17]) && !empty($item[14]) && !empty($item[15]) && !empty($item[16]) && !empty($item[18]) && !empty($item[19])) {
                    $ma = [
                        'time' => Carbon::createFromFormat('d/m/y', $item[14])->format('Y-m-d') ?? null,
                        'vnindex' => (float) $item[15],
                        'upMA50' => (float) $item[16],
                        'downMA50' => (float) $item[17],
                        'upMA200' => (float) $item[18],
                        'downMA200' => (float) $item[19],
                    ];

                    $maData = MaVnIndex::where('time', $ma['time'])->first();

                    if ($maData) {

                        $maData->update($ma);
                    } else {
                        MaVnIndex::create($ma);
                    }
                }
                if (!empty($item[11])) {
                    $subgroups = [
                        'group_name' => $item[11] ?? '',
                        'previous_session' => (float) $item[12],

                    ];

                    $subgroup = SubGroupVnIndex::where('group_name', $subgroups['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups);
                    } else {
                        SubGroupVnIndex::create($subgroups);
                    }
                }
                if (!empty($item[21])) {
                    $subgroups_year = [
                        'group_name' => $item[21] ?? '',
                        'current_year' => (float) $item[22],
                    ];
                    $subgroup = SubGroupVnIndex::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroupVnIndex::create($subgroups_year);
                    }
                }
                if (!empty($item[24])) {
                    $subgroups_year = [
                        'group_name' => $item[24] ?? '',
                        'quarter' => (float) $item[25],
                    ];
                    $subgroup = SubGroupVnIndex::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroupVnIndex::create($subgroups_year);
                    }
                }
                if (!empty($item[27])) {
                    $subgroups_year = [
                        'group_name' => $item[27] ?? '',
                        'current_month' => (float)$item[28],
                    ];
                    $subgroup = SubGroupVnIndex::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroupVnIndex::create($subgroups_year);
                    }
                }
                if (!empty($item[36])) {
                    $subgroups_year = [
                        'group_name' => $item[36] ?? '',
                        'avg_cap' => (float) $item[37],
                    ];
                    $subgroup = SubGroupVnIndex::where('group_name', $subgroups_year['group_name'])->first();
                    if ($subgroup) {
                        $subgroup->update($subgroups_year);
                    } else {
                        SubGroupVnIndex::create($subgroups_year);
                    }
                }
                if (!empty($item[30])) {
                    $group_cap = [
                        'group' => $item[30] ?? '',
                        'avg_day' => (float) $item[31],
                    ];
                    $cap = GroupCapVnIndex::where('group', $group_cap['group'])->first();
                    if ($cap) {
                        $cap->update($group_cap);
                    } else {
                        GroupCapVnIndex::create($group_cap);
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
                return redirect()->route('admin.vnindex.index')->with('error', __('panel.error'));
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
        $signals = ['TIỀN MẶT', 'NẮM GIỮ', 'MUA', 'BÁN'];
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
