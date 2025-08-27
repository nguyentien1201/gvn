<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\ConstantModel;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{
    public function index(Request $request)
    {
        $users = User::paginate(ConstantModel::$PAGINATION);
        $roles = ConstantModel::ROLES;
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create(Request $request)
    {
        $roles = ConstantModel::ROLES;
        return view('admin.users.create', compact('roles'));
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
        $user = User::find($id);
        $roles = ConstantModel::ROLES;
        return view('admin.users.edit', compact('user', 'roles'));
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
            return redirect()->route('admin.users.index')->with('success', __('panel.success'));
        }

    }

    public function destroy( $id)
    {
        try {
            $user = User::find($id);

            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.users.index')->with('success', __('panel.success'));
    }
    public function createUser(StoreUserRequest $request)
    {
        return false;
        $user = new User();
        $user->fill(!empty($request->password) ? $request->all() : $request->except('password'));
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->is_active =1;
        try {
            \Log::info($user);
            $user->save();
            if(!empty($request->manager_id)) {
                $user->profile()->create(['manager_id' => $request['manager_id']]);
            }
        } catch (\Exception $e) {
              \Log::info($e);

        }
        return redirect()->route('account')->with('success', __('panel.success'));
    }
}
