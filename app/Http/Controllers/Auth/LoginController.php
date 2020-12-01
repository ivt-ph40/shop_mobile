<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Session;
session_start();
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
        $email = $request->email;
        $password = md5($request->password);
        // dd($data);
        $result = User::where('email', $email)->where('password', $password)->first();
        if ($result) {
            Session::put('name', $result ->name);
            Session::put('id', $result ->id);
            return Redirect()->route('home.index');
        }
        return Redirect()->back()->with('message', 'Mật khẩu hoặc tài khoản không đúng!')->withInput();
    }
    public function logout(Request $request)
    {
        Session::put('name', null);
        Session::put('id', null);
        return Redirect()->route('users.showLoginForm');
    }
}
