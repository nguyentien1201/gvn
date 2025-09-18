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
       public static function normalizeDate($date) {
    // Nếu format là dd/mm/YYYY thì convert sang dd/mm/yy
        $d = DateTime::createFromFormat("d/m/Y", $date);

        if ($d && $d->format("d/m/Y") === $date) {
            return $d->format("d/m/y"); // -> 14/10/24
        }

            return $date;
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

        // $listSignal =$this->googleDriveService->getSheetData($fileUrl, 'Stock-VNindex!AZ:CE');
        $filePath = __DIR__ . '/stock_signals.json';
        $listSignal = json_decode(file_get_contents($filePath), true);


        $listSignal = array_slice($listSignal, 2);

        $result = [];
        foreach ($listSignal as $row) {
            $ma_ck = $row[0]; // mã chứng khoán
            // bỏ 2 phần tử đầu tiên trong mỗi row (mã CK + ngành)
            $signals = array_slice($row, 2);

            // chia thành block 8 phần tử
            for ($i = 0; $i < count($signals); $i += 6) {
                $block = array_slice($signals, $i, 6);
                try {
                    if (count($block) == 6 && !empty($block[5])) {
                        dump($block[5]);
                        $open_time = !empty($block[5]) ? self::normalizeDate($block[5]) : null;
                        $close_time = !empty($block[5]) ? self::normalizeDate($block[2]) : null;


                        $result[] = [
                            'code' => $ma_ck,
                            'close_price' => $block[1], // vị trí 4 trong mảng gốc
                            'close_time' => Carbon::createFromFormat('d/m/y', trim($close_time))->format('Y-m-d')?? null,
                            'open_price' => $block[4], // vị trí 7 trong mảng gốc
                            'open_time' => Carbon::createFromFormat('d/m/y', trim( $open_time ))->format('Y-m-d')?? null

                        ];
                    }
                } catch (Exception $e) {
                    dump($block);
                    dd($e->getMessage());
                }
            }
        }

        if(!empty($result)){

            foreach ($result as $row) {
                try {
                     DB::table('stock_signal_vnindex')->updateOrInsert(
                    [
                        'code' => $row['code'],
                        'open_time' => $row['open_time'],
                        'open_price' => $row['open_price'],
                    ],
                    [
                        'close_price' => $row['close_price'],
                        'close_time' => $row['close_time'],
                        'updated_at' => now(),
                    ]
                );
                } catch (\Exception $e) {
                    \Log::info($e->getMessage());
                    dd(1);
                    continue;
                }

            }

        }
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
        $getData = $this->with(['companyInfo','stockSignalsHistory'=> function($query) {
            $query->orderBy('updated_at', 'desc');
        }]);

        $data = $getData->orderBy('rating', 'asc')->limit($limit)->get();

        $list_code = $getData->orderBy('code', 'asc');
        $data = $data->map(function ($item) {
            if ($item->companyInfo) {
                $item['company_name'] = $item->companyInfo->company_name;
                $item['history'] = self::processDataHistory($item->stockSignalsHistory->toArray(), $item->current_price);
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
    public function stockSignalsHistory()
    {
        return $this->hasMany(StockSignalVnIndex::class, 'code', 'code');
    }
    public static function processDataHistory($signals, $price) {
        $result = [];
        $signals = array_slice($signals, 0, 5);
        foreach ($signals as $signal) {
            $openTime = Carbon::parse($signal['open_time']);
            $closeTime = $signal['close_time'] ? Carbon::parse($signal['close_time']) : Carbon::now();
            $closePrice = $signal['close_price'] ?? $price ?? null;

            $profit = $closePrice !== null ? $closePrice - $signal['open_price'] : null;
            $holdingDays = $closeTime->diffInDays($openTime);

            $result[] = [
                'code' => $signal['code'],
                'buy_price' => $signal['open_price'],
                'sell_price' => $signal['close_price'] ?? null,
                'profit' =>round($profit, 2) ,
                'holding_days' => $holdingDays,
            ];
        }
        return $result;
    }
}
