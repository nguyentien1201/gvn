<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MstStock\StoreMstStockRequest;
use App\Http\Requests\MstStock\UpdateMstStockRequest;
use App\Imports\CustomerImport;
use App\Models\ConstantModel;
use App\Models\Users;
use App\Models\GreenBeta;
use App\Models\MstStock;
use App\Models\SignalFree;
use App\Service\WooCommerceApiService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MstStockController extends AdminController
{
    public function index(Request $request)
    {
        $groups = ConstantModel::GROUP;
        $searchMstStock = MstStock::all();
        $mstStocks = (new MstStock())->getListMstStock($request);

        return view('admin.mst_stock.index', compact('mstStocks', 'searchMstStock','groups'));
    }

    public function create()
    {

        $listGroup = ConstantModel::GROUP;
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

    public function edit($id)
    {
        $mst_stock = mstStock::find($id);
        $listGroup = ConstantModel::GROUP;
        return view('admin.mst_stock.edit', compact('mst_stock','listGroup'));
    }

    public function update($id, UpdateMstStockRequest $request)
    {

        $mstStock = mstStock::find($id);
        $mstStock->fill($request->all());
        try {
            $mstStock->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.mst-stock.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.mst-stock.index')->with('success', __('panel.success'));
    }

    public function destroy($id)
    {
        try {
            $signal = SignalFree::where('code', $id)->get();
            $greenBeta = GreenBeta::where('code', $id)->get();

            if($signal->count() > 0 || $greenBeta->count() > 0){
                return redirect()->route('admin.mst-stock.index')->with('fail', 'Không thể xóa mã cổ phiếu này');
            }
            $mstStock= mstStock::find($id);
            $mstStock->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.mst-stock.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.mst-stock.index')->with('success', __('panel.success'));
    }


}
