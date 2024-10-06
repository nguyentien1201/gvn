<?php

namespace App\Http\Controllers\Admin;

use App\Models\ConstantModel;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends AdminController
{
    public function index(Request $request)
    {
        $products = Product::all();
        return view('admin.product.index', compact('products' ));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $request->validate([
            'name' => 'required',
            'monthly_price' => 'required|numeric',
            'six_month_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
        ]);
        $request['description'] = trim($request['description']);
        $product->fill($request->all());
        try {
            $product->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.product.index')->with('success', __('panel.success'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Product $product,Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);
        $request['description'] = trim($request['description']);

        $product->fill($request->all());
        try {
            $product->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.product.index')->with('success', __('panel.success'));
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.product.index')->with('success', __('panel.success'));
    }

    public function import(Request $request) {
        $path = $request->file('select_file');
        $customer = new CustomerImport();
        try {
            Excel::import($customer, $path);
            if ($request->type_upload == 0) {
                return back()->with('success', __('panel.success'));
            }
        } catch (\Exception $e) {
            return back()->with('fail', __('panel.fail'));
        }
    }

}
