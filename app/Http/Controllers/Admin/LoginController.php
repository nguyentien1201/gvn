<?php
/**
 * Created by PhpStorm.
 * User: ASTO-22
 * Date: 11/4/2019
 * Time: 10:43
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Login\StoreLoginRequest;
use App\Model\ConstantsModel;
use App\Model\SettingTheme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(StoreLoginRequest $request)
    {
        $email_or_phone_number = $request->email_or_phone_number;
        $password = $request->password;
        $remember = $request->remember;
        if (Auth::attempt(['email' => $email_or_phone_number, 'password' => $password], $remember) || Auth::attempt(['phone_number' => $email_or_phone_number, 'password' => $password], $remember)) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with('fail', __('general.fail_login'))->withInput();
        }
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
