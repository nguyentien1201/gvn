<?php

namespace App\Http\Controllers\Admin;

use App\Models\ConstantModel;
use App\Models\Users;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Subscription;

class SubscriptionController extends AdminController
{
    public function index(Request $request)
    {

        $subscriptions = (new Subscription())->getListSubscription();
        return view('admin.subscription.index', compact('subscriptions' ));
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

    public function edit(Product $product)
    {
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

    public function destroy($id)
    {
        try {
            $subscription = Subscription::find($id);
            if(!$subscription){
                return redirect()->route('admin.subscription.index')->with('fail', 'Không thể xóa subscription');
            }
            $subscription->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.subscription.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.subscription.index')->with('success', __('panel.success'));
    }


}
