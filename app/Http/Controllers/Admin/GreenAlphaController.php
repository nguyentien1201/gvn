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
class GreenAlphaController extends AdminController
{
    private $greenBeta;
    public function __construct()
    {
        $this->greenBeta = new GreenAlpha();
    }
    public function index()
    {

        $query = MstStock::select();
        $signals = $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);

        return view('admin.green_alpha.list_stock',compact('signals'));
    }
    public function getListMstock($id,Request $request)
    {
        $searchGreenBetas = GreenAlpha::all();
        $signals = (new GreenAlpha())->getListSignalsById($id,$request);
        $mstStocks = (new MstStock())->getListMstStock($request);
        return view('admin.green_alpha.index', compact('signals', 'searchGreenBetas','mstStocks'));
    }


    public function create()
    {
        $mstStocks = (new MstStock())->getListMstStockIds();
        return view('admin.green_alpha.create',compact('mstStocks'));
    }

    public function store(Request $request)
    {

        $request['open_time'] = Carbon::parse($request['open_time'])->format('Y-m-d H:i:s');

        if(!empty($request['close_time'])){
            $request['close_time'] = Carbon::parse($request['close_time'])->format('Y-m-d H:i:s');
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
        $mstStocks = (new MstStock())->getListMstStockIds();
        return view('admin.green_alpha.edit', compact('signal','mstStocks'));
    }

    public function update($id, UpdateGreenBetaRequest $request)
    {
        $request['open_time'] = Carbon::parse($request['open_time'])->format('Y-m-d H:i:s');
        if(!empty($request['close_time'])){
            $request['close_time'] = Carbon::parse($request['close_time'])->format('Y-m-d H:i:s');
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
    public function import(Request $request) {
        $path = $request->file('select_file');
        $listCode = MstStock::pluck('id','code')->toArray();
        $greenBeta = new GreenBetaImport();
        $arrayData = Excel::toArray(new GreenBetaImport(), $path);
        $sheetData = $arrayData[0];

        $c = new GreenAlpha();
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
            $existingRecord = GreenAlpha::where(['code'=>$greenBeta['code'],'price_open'=>$greenBeta['price_open'],'price_close'=>$greenBeta['price_close']])->first();
            if ($existingRecord) {
                $existingRecord->update($greenBeta);
            } else {
                // Record does not exist, insert new
                GreenAlpha::create($greenBeta);
            }
            } catch (\Exception $e) {
                continue;
            }

        }
        if ($request->type_upload == 0) {
            return back()->with('success', __('panel.success'));
        }


    }
}