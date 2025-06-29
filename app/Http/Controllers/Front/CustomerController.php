<?php
namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConstantModel;
use Carbon\Carbon;
use App\Models\Profile;
class CustomerController
{
    public function myAccount(){
        $subscriptions = (new Subscription())->getMySubscription();

        $info = User::with(['profile.UserManager'])->where('id', Auth::id())->select('id', 'email',  'name')->first();
        $product = Product::all();

        $price_product = [];
        foreach ($product as $key => $value) {
            $system = $value->system ?? '';
            $price_product[$system] = $value;
        }
        $id = Auth::id();
        $customers = (new User())->getListUser($id);
        return view('frontend_v2.my_account', compact('subscriptions','info','price_product','customers'));
    }
    public function update( Profile $profile ,Request $request)
    {

        try {
            $managerId = null;
            $request['birthday'] = Carbon::parse($request['birthday'])->format('Y-m-d');
            $manager  = $request['manager'];
            if(!empty($manager) && filter_var($manager, FILTER_VALIDATE_EMAIL)) {
              $managerId = optional(User::where('role_id', ConstantModel::ROLES['customer'])
                    ->where('email', $manager)
                    ->first())->id;
            }

            $request['manager_id'] = $managerId;
            $user_id = Auth::id();
            $profile = Profile::where('user_id', $user_id)->first();

            if($profile){
                $profile->update($request->all());
            }else {
                $profile = new Profile();
                $profile->fill($request->all());
                $profile->user_id = $user_id;
                $profile->save();
            }
        } catch (\Exception $e) {
            return redirect()->route('account')->with('fail', __('panel.fail'));
        }
        return redirect()->route('account')->with('success', __('panel.success'));
    }
    public function activate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid activation link.');
        }

        $user->update(['activation_token' => null, 'is_active' => true]);

        return redirect()->route('login')->with('success', 'Your account has been activated!');
    }
}
