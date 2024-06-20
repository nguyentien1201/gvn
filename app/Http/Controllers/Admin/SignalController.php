<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Signal\StoreSignalRequest;
use App\Http\Requests\Signal\UpdateSignalRequest;
use App\Imports\CustomerImport;
use App\Models\ConstantModel;
use App\Models\MstStock;
use App\Models\Customer;
use App\Models\Signal;
use App\Service\WooCommerceApiService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SignalController extends AdminController
{
    public function index(Request $request)
    {
        $searchSignals = Signal::all();

        $signals = (new Signal())->getListSignals($request);

        $mstStocks = (new MstStock())->getListMstStock($request);
        return view('admin.signal.index', compact('signals', 'searchSignals','mstStocks'));
    }

    public function create()
    {
        $mstStocks = (new MstStock())->getListMstStockIds();
        return view('admin.signal.create',compact('mstStocks'));
    }

    public function store(StoreSignalRequest $request)
    {

        $signal = new Signal();
        $signal->fill($request->all());
        try {

            $signal->save();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('admin.signal.index')->with('fail', __('panel.fail'));
        }

        return redirect()->route('admin.signal.index')->with('success', __('panel.success'));
    }

    public function edit(Signal $signal)
    {
        $mstStocks = (new MstStock())->getListMstStockIds();
        return view('admin.signal.edit', compact('signal','mstStocks'));
    }

    public function update(Signal $signal, UpdateSignalRequest $request)
    {
        $signal->fill($request->all());
        try {
            $signal->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.signal.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.signal.index')->with('success', __('panel.success'));
    }

    public function destroy(Signal $signal)
    {
        try {
            $signal->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.signal.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.signal.index')->with('success', __('panel.success'));
    }
}
