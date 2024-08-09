<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GreenBeta\StoreGreenBetaRequest;
use App\Http\Requests\GreenBeta\UpdateGreenBetaRequest;
use App\Imports\GreenBetaImport;
use App\Models\ConstantModel;
use App\Models\MstStock;
use App\Models\GreenAlpha;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\GreenStockNas100;
use GuzzleHttp\Client;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use App\Service\GoogleDriveService;
class GreenStockNas100Controller extends AdminController
{
    private $greenBeta;
    private $nas100;
    protected $googleDriveService;
    public function __construct()
    {
        $this->googleDriveService = new GoogleDriveService();
        $this->nas100 = new GreenStockNas100();
        $this->greenBeta = new GreenAlpha();
    }
    public function index()
    {

        $signals = $this->nas100->getListNas100();
        return view('admin.nas100.index',compact('signals'));
    }


    public function create()
    {
        $mstStocks = (new MstStock())->getListMstStockIdsAlpha();
        return view('admin.portfolio.create',compact('mstStocks'));
    }

    public function store(Request $request)
    {

        $request['open_time'] = Carbon::parse($request['open_time'])->format('d/m/Y H:i:s');

        if(!empty($request['close_time'])){
            $request['close_time'] = Carbon::parse($request['close_time'])->format('d/m/Y H:i:s');
        }
        $signal = new GreenAlpha();
        $signal->fill($request->all());

        try {
            $signal->save();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('admin.green-alpha.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.green-alpha.index')->with('success', __('panel.success'));
    }

    public function edit($id)
    {
        $signal = GreenAlpha::find($id);
        $mstStocks = (new MstStock())->getListMstStockIdsAlpha();
        return view('admin.portfolio.edit', compact('signal','mstStocks'));
    }

    public function update($id, UpdateGreenBetaRequest $request)
    {
        $request['open_time'] = Carbon::parse($request['open_time'])->format('d/m/Y H:i:s');
        if(!empty($request['close_time'])){
            $request['close_time'] = Carbon::parse($request['close_time'])->format('d/m/Y H:i:s');
        }
        $signal = GreenAlpha::find($id);
        $signal->fill($request->all());
        try {
            $signal->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.green-alpha.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.green-alpha.index')->with('success', __('panel.success'));
    }

    public function destroy($id)
    {
        try {
            $signal = GreenAlpha::find($id);
            $signal->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.green-alpha.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.green-alpha.index')->with('success', __('panel.success'));
    }
    public function import() {
        $this->nas100->import();
        return redirect()->route('admin.nas100.index')->with('success', __('panel.success'));
    }
    public function portfolio(Request $request)
    {
        // $portfolio = (new GreenAlphaPortfolio())->getPortfolio();
        $list_code = (new GreenAlphaPortfolio())->getListCode();
        return view('admin.portfolio.index',compact('list_code'));
    }
    public function importPortfolio(Request $request)
    {
        $path = $request->file('select_file');
        $arrayData = Excel::toArray(null, $path);

        $sheetData = $arrayData[0];

        $headerRow = $sheetData[0];
        $header =[];
        $listCode = MstStock::pluck('id','code')->toArray();
        foreach($headerRow as $key => $value) {
            if($key==0){
                $header[$key] = 'code';
                continue;
            }
            $header[$key] = strtolower($value);
        }
          // Get the data rows without formatting
        $dataRows = array_slice($sheetData, 1);

        foreach ($dataRows as $row) {
            if(empty($row[0])) continue;
            $code ='';
            foreach ($row as $key => $value) {
                if($key == 0) {
                    $code = $value;
                    continue;
                }

                $data =[
                    'code_id'=> $listCode[$code],
                    'code'=> $code,
                    'month_year'=>$header[$key],
                    'profit'=>$value
                ];

                $existingRecord = GreenAlphaPortfolio::where(['code_id'=>$data['code_id'],'month_year'=>$data['month_year']])->first();
                if ($existingRecord) {
                    $existingRecord->update($data);
                } else {
                    // Record does not exist, insert new
                    GreenAlphaPortfolio::create($data);
                }

            }
        }
        return redirect()->route('admin.green-alpha.index')->with('success', __('panel.success'));
    }
    public function getPortfolio($id,Request $request)
    {
        $portfolio = (new GreenAlphaPortfolio)->getPortfolio($id);
        return view('admin.portfolio.index', compact('portfolio'));
    }
    public function googleDriveCallback(Request $request)
    {
        $this->googleDriveService->authenticate($request->get('code'));
        return redirect()->route('import-form');
    }
}
