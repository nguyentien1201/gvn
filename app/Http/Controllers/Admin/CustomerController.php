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

class CustomerController extends AdminController
{
    public function index(Request $request)
    {
        $customers = (new User())->getListCustomers();

        return view('admin.customers.index', compact('customers'));
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

    public function store(StoreUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = new User();
        $user->fill(!empty($request->password) ? $request->all() : $request->except('password'));
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.users.index')->with('success', __('panel.success'));
    }

    public function edit($id)
    {
        $customer = User::find($id);
        $roles = ConstantModel::ROLES;
        return view('admin.customers.edit', compact('customer'));
    }

   public function update( $id,Request $request): \Illuminate\Http\RedirectResponse
    {
        $approve = $request->approve ?? '';
        $user = User::find($id);
        if(!$user){
            return redirect()->route('admin.users.index')->with('fail', __('panel.fail'));
        }
        $user->fill(!empty($request->password) ? $request->all() : $request->except('password'));
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('fail', __('panel.fail'));
        }
        if( $approve == 'approve') {
            return redirect()->route('admin.approve-account.index')->with('success', __('panel.success'));
        } else {
            return redirect()->route('admin.customers.index')->with('success', __('panel.success'));
        }
        
    }

    public function destroy(User $customer)
    {
        try {
            $customer->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.customers.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.customers.index')->with('success', __('panel.success'));
    }

    // public function import(Request $request) {
    //     $path = $request->file('select_file');
    //     $customer = new CustomerImport();
    //     try {
    //         Excel::import($customer, $path);
    //         if ($request->type_upload == 0) {
    //             return back()->with('success', __('panel.success'));
    //         }
    //     } catch (\Exception $e) {
    //         return back()->with('fail', __('panel.fail'));
    //     }
    // }
}
