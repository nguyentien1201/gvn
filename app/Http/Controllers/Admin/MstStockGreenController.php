<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MstStockGreen\StoreMstStockGreenRequest;
use App\Http\Requests\MstStockGreen\UpdateMstStockGreenRequest;
use App\Imports\CustomerImport;
use App\Models\ConstantModel;
use App\Models\Users;
use App\Models\MstStockGreen;
use App\Models\GreenBeta;
use App\Service\WooCommerceApiService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MstStockGreenController extends AdminController
{
    public function index(Request $request)
    {
        $groups = ConstantModel::GROUP;
        $searchMstStockGreen = MstStockGreen::all();
        $MstStockGreens = (new MstStockGreen())->getListMstStockGreen($request);

        return view('admin.mst_stock_green.index', compact('MstStockGreens', 'searchMstStockGreen','groups'));
    }

    public function create()
    {

        $listGroup = ConstantModel::GROUP;
        return view('admin.mst_stock_green.create',compact('listGroup'));
    }

    public function store(StoreMstStockGreenRequest $request)
    {
        $MstStockGreen = new MstStockGreen();
        $MstStockGreen->fill($request->all());

        try {
            $MstStockGreen->save();
        } catch (\Exception $e) {

            return redirect()->route('admin.stock-green-beta.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.stock-green-beta.index')->with('success', __('panel.success'));
    }

    public function edit($id)
    {
        $mst_stock = MstStockGreen::find($id);
        $listGroup = ConstantModel::GROUP;
        return view('admin.mst_stock_green.edit', compact('mst_stock','listGroup'));
    }

    public function update(MstStockGreen $MstStockGreen, UpdateMstStockGreenRequest $request)
    {

        $MstStockGreen->fill($request->all());

        try {
            $MstStockGreen->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.stock-green-beta.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.stock-green-beta.index')->with('success', __('panel.success'));
    }

    public function destroy($id)
    {
        try {

            $greenbeta = GreenBeta::where('code', $id)->get();
            if($greenbeta->count() > 0){
                return redirect()->route('admin.stock-green-beta.index')->with('fail', 'Không thể xóa mã cổ phiếu này');
            }
            $MstStockGreen = MstStockGreen::find($id);
            $MstStockGreen->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.stock-green-beta.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.stock-green-beta.index')->with('success', __('panel.success'));
    }


}
