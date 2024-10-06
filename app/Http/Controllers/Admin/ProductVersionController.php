<?php

namespace App\Http\Controllers\Admin;

use App\Models\ConstantModel;
use App\Models\Customer;
use App\Models\ProductVersion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
class ProductVersionController extends AdminController
{
    public function index(Request $request)
    {
        $products = ProductVersion::all();
        return view('admin.product_version.index', compact('products' ));
    }

    public function create()
    {
        return view('admin.product_version.create');
    }

    public function store(Request $request)
    {

        $product = new ProductVersion();
        $request->validate([
            'name_product' => 'required',
            'version_number' => 'required',
            'release_date' => 'required',
            'is_current' => 'required',
        ]);
        $request['is_current'] =$request['is_current'] == 'on' ? 1 : 0;
        $request['release_date'] = Carbon::parse($request['release_date'])->format('Y-m-d H:i:s');
        $product->fill($request->all());
        try {
            $is_product = ProductVersion::where('name_product',$request['name_product'])->where('version_number',$request['version_number'])->first();
            if($is_product){
                $is_product->update($request->all());
            }else{
                $product->save();
            }

             return redirect()->route('admin.product-version.index')->with('success', __('panel.success'));
        } catch (\Exception $e) {

            return redirect()->route('admin.product-version.index')->with('fail', __('panel.fail'));
        }

    }

    public function edit($id)
    {
        $product = ProductVersion::find($id);
        return view('admin.product_version.edit', compact('product'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_versions,id',
        ]);

        $request['is_current'] = $request['is_current'] == 'on' ? 1 : 0;
        $request['release_date'] = Carbon::parse($request['release_date'])->format('Y-m-d H:i:s');
        $product = ProductVersion::find($id);
        $product->fill($request->all());
        try {
            $product->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.product-version.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.product-version.index')->with('success', __('panel.success'));
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.product-version.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.product-version.index')->with('success', __('panel.success'));
    }



}
