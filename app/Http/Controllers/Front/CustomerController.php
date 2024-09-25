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
        $info = User::with(['profile'])->where('id', Auth::id())->select('id', 'email',  'name')->first();
        return view('front.my_account', compact('subscriptions','info'));
    }
    public function update( Profile $profile ,Request $request)
    {

        try {
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
}
