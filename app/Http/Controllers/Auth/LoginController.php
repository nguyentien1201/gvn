<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ConstantModel;
use App\Models\Token;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;
    protected $is_active;

    /**
     * Check user's role and redirect user based on their role
     * @return
     */

    protected function authenticated()
    {
        $user = auth()->user();
        if ($user) {
            if($user->is_active ==1){
                $this->redirectTo = route('front.home.index');
            }

        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
        $this->username = $this->findUsername();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUserName(): string
    {
        $login = request()->input('email');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
    function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the user exists and if the account is active
        $user = User::where($this->username(), $request->{$this->username()})->first();

        if ($user && !$user->is_active) {
            throw ValidationException::withMessages([
                $this->username() => ['Your account is not active. Please Active from email '],
            ]);
        }
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }
    public function isActive(): int
    {
        return $this->is_active ?? null;
    }


}
