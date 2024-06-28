<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GreenBeta\StoreGreenBetaRequest;
use App\Http\Requests\GreenBeta\UpdateGreenBetaRequest;
use App\Models\ConstantModel;
use App\Models\MstStockGreen;
use App\Models\GreenBeta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GreenBetaController extends AdminController
{
    public function index(Request $request)
    {
        $searchGreenBetas = GreenBeta::all();
        $signals = (new GreenBeta())->getListSignals($request);
        $mstStocks = (new MstStockGreen())->getListMstStockGreen($request);

        return view('admin.green_beta.index', compact('signals', 'searchGreenBetas','mstStocks'));
    }

    public function create()
    {
        $mstStocks = (new MstStockGreen())->getListMstStockGreenIds();
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
        $mstStocks = (new MstStockGreen())->getListMstStockGreenIds();
        return view('admin.green_beta.edit', compact('signal','mstStocks'));
    }

    public function update(GreenBeta $signal, UpdateGreenBetaRequest $request)
    {
        $request['open_time'] = Carbon::parse($request['open_time'])->format('Y-m-d H:i:s');
        $request['close_time'] = Carbon::parse($request['close_time'])->format('Y-m-d H:i:s');
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
}
