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
class GreenStockNas100 extends Model
{
    use SoftDeletes;
    protected $googleDriveService;
    public $table = 'greenstock_nas100';
    protected $fillable = [
        'rating','code', 'point','price','trending','signal','profit','post_sale_discount','time','created_at'
    ];
    public function getListNas100(){
        $data = $this->orderBy('rating','asc')->paginate(ConstantModel::$PAGINATION);
        return $data;
    }
    public function import($isCompany = false){
        $this->googleDriveService = new GoogleDriveService();
        $fileUrl = config('drivefile.drivefile.nas100');
        $isCompany =true;
        if($isCompany ==true){
            $company = $this->googleDriveService->getSheetData($fileUrl,'Tên doanh nghiệp!A1:B');
            array_shift($company);
            foreach($company as $item){
                $company = [
                    'code' => $item[0],
                    'company_name' => $item[1],
                ];
                $companyInfo = CompanyInfo::where('code',$company['code'])->first();
                if($companyInfo){
                    $companyInfo->update($company);
                }else{
                    CompanyInfo::create($company);
                }
            }
        }
        $fileContent = $this->googleDriveService->getFile($fileUrl);

        $listData = explode("\r\n", $fileContent);

        array_shift($listData);
        array_shift($listData);
        foreach($listData as $item){
            try {
                dump($item);
            $greenstock_nas100 = [];
            $item = explode(",", $item);

            if(!empty($item[17]) && !empty($item[14]) && !empty($item[15]) && !empty($item[16])){
                $ma = [
                    'upMA50'=> (float)$item[14],
                    'downMA50'=> (float)$item[15],
                    'upMA200'=> (float)$item[16],
                    'downMA200'=> (float)$item[17],
                ];
                $maData = Ma::first();
                if($maData){
                    $maData->update($ma);
                }else{
                    Ma::create($ma);
                }
            }
            if(!empty($item[11])) {
                $subgroups = [
                    'group_name' => $item[11] ?? '',
                    'previous_session' =>(float) $item[12],

                ];
                $subgroup = SubGroup::where('group_name',$subgroups['group_name'])->first();
                if($subgroup){
                    $subgroup->update($subgroups);
                }else{
                    SubGroup::create($subgroups);
                }
            }
            if(!empty($item[19])) {
                $subgroups_year = [
                    'group_name' => $item[19] ?? '',
                    'current_year' => (float) $item[20],
                ];
                $subgroup = SubGroup::where('group_name',$subgroups_year['group_name'])->first();
                if($subgroup){
                    $subgroup->update($subgroups_year);
                }else{
                    SubGroup::create($subgroups_year);
                }
            }

            $greenstock_nas100= [
                'rating' => (int)$item[0],
                'code' => $item[1],
                'point' => (int)$item[2],
                'current_price' => (float)$item[8],
                'trending'=>$item[3],
                'signal' => $item[4],
                'profit'=> (float)$item[5],
                'post_sale_discount'=>!empty($item[6]) ? (float)$item[6] : null,
                'price'=> round((float)$item[7], 2),
                'time'=> Carbon::createFromFormat('d/m/y', $item[9])->format('Y-m-d') ?? null,
            ];
            $nas100 = self::where('code',$greenstock_nas100['code'])->first();
            if($nas100){
                $nas100->update($greenstock_nas100);
            }else{
                self::create($greenstock_nas100);
            }
            }catch (\Exception $e){
                dump($item);
                dd($e->getMessage());
                continue;
            }
        }
        return redirect()->route('admin.nas100.index')->with('success', __('panel.success'));
    }
    public function getListNas100Api($limit=200){
        $data = $this->with('companyInfo')->orderBy('rating','asc')->limit($limit)->get();
        $data = $data->map(function($item){
            if($item->companyInfo){
                $item['company_name'] = $item->companyInfo->company_name;
            }
            return $item;
        });

        return $data;
    }
    public function companyInfo()
    {
        return $this->belongsTo(CompanyInfo::class, 'code', 'code');
    }
}
