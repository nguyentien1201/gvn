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
            $request['birthday'] = Carbon::parse($request['birthday'])->format('Y-m-d');
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
