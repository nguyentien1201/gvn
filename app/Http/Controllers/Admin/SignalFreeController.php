<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SignalFree\StoreSignalRequest;
use App\Http\Requests\SignalFree\UpdateSignalRequest;
use App\Imports\GreenBetaImport;
use App\Models\ConstantModel;
use App\Models\MstStock;
use App\Models\SignalFree;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class SignalFreeController extends AdminController
{
    public function index(Request $request)
    {
        $searchSignals = SignalFree::all();

        $signals = (new SignalFree())->getListSignals($request);

        $mstStocks = (new MstStock())->getListMstStock($request);
        return view('admin.signal_free.index', compact('signals', 'searchSignals','mstStocks'));
    }

    public function create()
    {
        $mstStocks = (new MstStock())->getListMstStockNotIn();

        $groups = ConstantModel::GROUP;
        return view('admin.signal_free.create',compact('mstStocks','groups'));
    }

    public function store(StoreSignalRequest $request)
    {

        $request['date_action'] = Carbon::parse($request['date_action'])->format('Y-m-d H:i:s');
        $signal = new SignalFree();
        $signal->fill($request->all());

        try {
            $signal->save();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('admin.freesignal.index')->with('fail', __('panel.fail'));
        }

        return redirect()->route('admin.freesignal.index')->with('success', __('panel.success'));
    }

    public function edit($id)
    {

        $signalsFree = SignalFree::find($id);
        $mstStocks = (new MstStock())->getListMstStockIds();
        return view('admin.signal_free.edit', compact('signalsFree','mstStocks'));
    }

    public function update($id, UpdateSignalRequest $request)
    {
        $request['date_action'] = Carbon::parse($request['date_action'])->format('Y-m-d H:i:s');
        $signal = SignalFree::find($id);
        $signal->fill($request->all());
        try {
            $signal->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.freesignal.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.freesignal.index')->with('success', __('panel.success'));
    }

    public function destroy($id)
    {
        try {
            $signal = SignalFree::find($id);
            $signal->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.freesignal.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.freesignal.index')->with('success', __('panel.success'));
    }
    public function import(Request $request) {
        $path = $request->file('select_file');
        $listCode = MstStock::pluck('id','code')->toArray();
        $arrayData = Excel::toArray(new GreenBetaImport, $path);

        $sheetData = $arrayData[0];
        foreach ($sheetData  as $key => $sheet) {
            if(empty($sheet['code'])) continue;
            try {
                $date_action = str_replace('.', '-', substr($sheet['time'], 9) . ' ' . substr($sheet['time'], 0, 8));
                $trend_price = ConstantModel::TRENDING_PRICE_VALUE[strtolower($sheet['trendprice'])];
                $signal = [
                    'code' => $listCode[$sheet['code']],
                    'trend_price' =>$trend_price,
                    'last_sale' => $sheet['lastsale'],
                    'date_action' => Carbon::parse($date_action)->format('Y-m-d H:i:s'),
                ];
            $existingRecord = SignalFree::where(['code'=>$signal['code']])->first();
            if ($existingRecord) {
                $existingRecord->update($signal);
            } else {
                // Record does not exist, insert new
                SignalFree::create($signal);
            }
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
                continue;
            }

        }
        if ($request->type_upload == 0) {
            return back()->with('success', __('panel.success'));
        }


    }
}
