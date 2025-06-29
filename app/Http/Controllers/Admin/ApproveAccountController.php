<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Imports\CustomerImport;
use App\Models\ConstantModel;
use App\Models\User;
use App\Service\WooCommerceApiService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApproveAccountController extends AdminController
{
    public function index(Request $request)
    {
        $customers = (new User())->getListActive();

        return view('admin.approve_account.index', compact('customers'));
    }
    public function listUser($id)
    {
        $customers = (new User())->getListUser($id);
        if ($customers->isEmpty()) {
            return redirect()->route('admin.customers.index')->with('fail', __('panel.fail'));
        }

        return view('admin.customers.list', compact('customers'));
    }
    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = new Customer();
        $customer->fill($request->all());
        try {
            $customer->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.customers.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.customers.index')->with('success', __('panel.success'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Customer $customer, UpdateCustomerRequest $request)
    {
        $customer->fill($request->all());
        try {
            $customer->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.customers.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.customers.index')->with('success', __('panel.success'));
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.customers.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.customers.index')->with('success', __('panel.success'));
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
