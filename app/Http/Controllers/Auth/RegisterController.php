<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserActivationMail;
use Str;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'in:2,3']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'activation_token' => Str::random(60),
            'role_id' => $data['role_id'] ?? 3, // Default to user role if not provided
            'ip' => $data['ip']
        ]);
    }
    public function register(Request $request)
    {
        $userData = $request->all();
      
         $validator = $this->validator($userData);
        
    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

        $validatedData = $validator->validated();
      
        $userData['ip'] =  $request->ip() ?? '';
        $user = $this->create($userData);
        if(!empty($request['manager_id'])) {
            $user->profile()->create(['manager_id' => $request['manager_id']]);
        }
        if($user->role ==3){
            try {
                Mail::to($user->email)->send(new UserActivationMail($user));
            }catch(\Exception $e){
                \Log::error($e->getMessage());
            }
        }
       
        return redirect()->route('front.home.index'); // Redirect to a desired route after registration
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
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
