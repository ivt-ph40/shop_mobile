<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('users.login');
    }
    public function login(Request $request)
    {
        $data = $request->only('email', 'password');
        if (\Auth::attempt($data)) {
            return Redirect()->route('home.index');
        }
        return Redirect()->back()->with('message', 'Email or password wrong. Please try again!')->withInput();
    }
    public function logout(Request $request)
    {
        auth()->logout();
        return Redirect()->route('login.showLoginForm');
    }
}
