<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SignalFree\StoreSignalRequest;
use App\Http\Requests\SignalFree\UpdateSignalRequest;
use App\Models\ConstantModel;
use App\Models\MstStock;
use App\Models\SignalFree;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function update(SignalFree $signal, UpdateSignalRequest $request)
    {
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
}
