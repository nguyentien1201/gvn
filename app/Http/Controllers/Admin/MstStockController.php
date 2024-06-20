<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MstStock\StoreMstStockRequest;
use App\Http\Requests\MstStock\UpdateMstStockRequest;
use App\Imports\CustomerImport;
use App\Models\ConstantModel;
use App\Models\Customer;
use App\Models\MstStock;
use App\Service\WooCommerceApiService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MstStockController extends AdminController
{
    public function index(Request $request)
    {
        $listGroup = ConstantModel::$GROUP;
        $searchMstStock = MstStock::all();
        $mstStocks = (new MstStock())->getListMstStock($request);

        return view('admin.mst_stock.index', compact('mstStocks', 'searchMstStock','listGroup'));
    }

    public function create()
    {

        $listGroup = ConstantModel::$GROUP;
        return view('admin.mst_stock.create',compact('listGroup'));
    }

    public function store(StoreMstStockRequest $request)
    {
        $mstStock = new MstStock();
        $mstStock->fill($request->all());
        try {
            $mstStock->save();
        } catch (\Exception $e) {

            return redirect()->route('admin.mst-stock.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.mst-stock.index')->with('success', __('panel.success'));
    }

    public function edit(mstStock $mst_stock)
    {
        $listGroup = ConstantModel::$GROUP;
        return view('admin.mst_stock.edit', compact('mst_stock','listGroup'));
    }

    public function update(mstStock $mstStock, UpdateMstStockRequest $request)
    {

        $mstStock->fill($request->all());
        try {
            $mstStock->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.mst-stock.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.mst-stock.index')->with('success', __('panel.success'));
    }

    public function destroy(mstStock $mstStock)
    {
        try {
            $mstStock->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.mst-stock.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.mst-stock.index')->with('success', __('panel.success'));
    }


}
