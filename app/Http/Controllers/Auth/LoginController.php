<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Helper\Helper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = 'username';
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Rediriger les utilisateurs en fonction de leurs roles
     *
     * @return void
     */


    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials["state"] = 1;
        return $credentials;
    }


    protected function authenticated(Request $request, $user)
    {
        if (Hash::check('Ocades@2021', $user->password)) {
            return redirect('first-connexion/' . $user->id);
        }
        return redirect('/');
    }
}
