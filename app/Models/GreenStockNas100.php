<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\GoogleDriveService;
use Carbon\Carbon;
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
    public function import() {
        $this->googleDriveService = new GoogleDriveService();
        $fileUrl = config('drivefile.drivefile.nas100');
        $fileContent = $this->googleDriveService->getFile($fileUrl);
        $listData = explode("\r\n", $fileContent);
        array_shift($listData);
        array_shift($listData);
        foreach($listData as $item){
            $greenstock_nas100 = [];
            $item = explode(",", $item);
            $greenstock_nas100= [
                'rating' => (int)$item[0],
                'code' => $item[1],
                'point' => (int)$item[2],
                'trending'=>$item[3],
                'signal' => $item[4],
                'profit'=> (float)$item[5],
                'post_sale_discount'=>!empty($item[6]) ? (float)$item[6] : null,
                'price'=> round((float)$item[7], 2),
                'time'=> Carbon::createFromFormat('d/m/y', $item[8])->format('Y-m-d'),
            ];
            $nas100 = self::where('code',$greenstock_nas100['code'])->first();
            if($nas100){
                $nas100->update($greenstock_nas100);
            }else{
                self::create($greenstock_nas100);
            }
        }
        return redirect()->route('admin.nas100.index')->with('success', __('panel.success'));
    }
}
