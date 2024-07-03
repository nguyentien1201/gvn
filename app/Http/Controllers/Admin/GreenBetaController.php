<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GreenBeta\StoreGreenBetaRequest;
use App\Http\Requests\GreenBeta\UpdateGreenBetaRequest;
use App\Imports\GreenBetaImport;
use App\Models\ConstantModel;
use App\Models\MstStock;
use App\Models\GreenBeta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
class GreenBetaController extends AdminController
{
    private $greenBeta;
    public function __construct()
    {
        $this->greenBeta = new GreenBeta();
    }
    public function index()
    {

        $query = MstStock::select();
        $signals = $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
        return view('admin.green_beta.list_stock',compact('signals'));
    }
    public function getListMstock($id,Request $request)
    {
        $searchGreenBetas = GreenBeta::all();
        $signals = (new GreenBeta())->getListSignalsById($id,$request);

        $mstStocks = (new MstStock())->getListMstStock($request);

        return view('admin.green_beta.index', compact('signals', 'searchGreenBetas','mstStocks'));
    }


    public function create()
    {
        $mstStocks = (new MstStock())->getListMstStockIds();
        return view('admin.green_beta.create',compact('mstStocks'));
    }

    public function store(Request $request)
    {

        $request['open_time'] = Carbon::parse($request['open_time'])->format('Y-m-d H:i:s');
        $request['close_time'] = Carbon::parse($request['close_time'])->format('Y-m-d H:i:s');
        $signal = new GreenBeta();
        $signal->fill($request->all());

        try {
            $signal->save();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('admin.green-beta.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.green-beta.index')->with('success', __('panel.success'));
    }

    public function edit($id)
    {
        $signal = GreenBeta::find($id);
        $mstStocks = (new MstStock())->getListMstStockIds();
        return view('admin.green_beta.edit', compact('signal','mstStocks'));
    }

    public function update($id, UpdateGreenBetaRequest $request)
    {
        $request['open_time'] = Carbon::parse($request['open_time'])->format('Y-m-d H:i:s');
        $request['close_time'] = Carbon::parse($request['close_time'])->format('Y-m-d H:i:s');
        $signal = GreenBeta::find($id);
        $signal->fill($request->all());
        try {
            $signal->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.green-beta.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.green-beta.index')->with('success', __('panel.success'));
    }

    public function destroy($id)
    {
        try {
            $signal = GreenBeta::find($id);
            $signal->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.green-beta.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.green-beta.index')->with('success', __('panel.success'));
    }
    public function import(Request $request) {
        $path = $request->file('select_file');
        $listCode = MstStock::pluck('id','code')->toArray();


        $greenBeta = new GreenBetaImport();

            $arrayData = Excel::toArray(new GreenBetaImport(), $path);
            $sheetData = $arrayData[0];
        // Assuming you want to do something with the first sheet's data
            $sheetData = $arrayData[0]; // This gets the

            $c = new GreenBeta();
            $greenBeta = [];
            // $firstTenItems = array_slice($sheetData, 0, 10);

            foreach ($sheetData as $sheet) {
                if(empty($sheet['code'])) continue;
                try {
                    $openTime = str_replace('.', '-', substr($sheet['timeopen'], 9) . ' ' . substr($sheet['timeopen'], 0, 8));
                    $closeTime = str_replace('.', '-', substr($sheet['timeclose'], 9) . ' ' . substr($sheet['timeclose'], 0, 8));
                    $greenBeta = [
                        'code' => $listCode[$sheet['code']],
                        'signal_open' => $sheet['signal'],
                        'price_open' => $sheet['priceopen'],
                        'open_time' => Carbon::parse($openTime)->format('Y-m-d H:i:s'),
                        'close_time' => Carbon::parse($closeTime)->format('Y-m-d H:i:s'),
                        'signal_close' => $sheet['signalclose'],
                        'price_close' => $sheet['priceclose'],
                        'profit' => $sheet['profitloss'],

                    ];
                $existingRecord = GreenBeta::where(['code'=>$greenBeta['code'],'price_open'=>$greenBeta['price_open'],'price_close'=>$greenBeta['price_close']])->first();
                if ($existingRecord) {
                    $existingRecord->update($greenBeta);
                } else {
                    // Record does not exist, insert new
                    GreenBeta::create($greenBeta);
                }
                } catch (\Exception $e) {
                    continue;
                }

            }
            if ($request->type_upload == 0) {
                return back()->with('success', __('panel.success'));
            }


    }
    // public function getListMstock()
    // {
    //     $listCode = MstStock::pluck('code','id')->toArray();
    //     return view('admin.green_beta.list_stock',compact('listCode'));
    // }
}
