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

    public function edit(User $user)
    {
        $roles = ConstantModel::ROLES;
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateProfileRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
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

    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.users.index')->with('success', __('panel.success'));
    }
}
