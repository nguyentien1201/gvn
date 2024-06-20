<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\ConstantModel;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends AdminController
{
    public function index()
    {
        $user = Auth::user();
        $roles = ConstantModel::ROLES;
        $isProfile = 1;
        return view('admin.users.edit', compact('user', 'roles', 'isProfile'));
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $staff = User::findOrFail($id);
        $staff->fill(!empty($request->password) ? $request->all() : $request->except('password'));
        if (!empty($request->password)) {
            $staff->password = Hash::make($request->password);
        }
        try {
            $staff->save();
        } catch (\Exception $e) {
            return redirect()->route('admin.profile.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.profile.index')->with('success', __('panel.success'));
    }
}
