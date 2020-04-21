<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admin;
use App\Http\Controllers\Controller;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    function guard()
    {
        return Auth::guard('admin');
    }
    function loginPath()
    {
        return '/admin/login';
    }
    function login(Request $request)
    {
        dd(app('pragmarx.google2fa'));
        $admin = Admin::first();

        $google2fa = app('pragmarx.google2fa');
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        if ($admin->google2fa_on) {
            $rules['otp'] = 'required';
            $valid = $google2fa->verifyKey($admin->google2fa_secret, $request->get('otp'));
            if(!$valid )
            return redirect()->back()->with('otp_error', 'Invalid OTP');
        }
        $request->validate($rules);

        // dd($request->only(['email','password']));
        if ($this->guard()->attempt(
            $request->only(['email', 'password']),
            $request->has('remember')
        )) {
            return redirect('/admin/dashboard');
        } else {
            return redirect($this->loginPath());
        }

    }
}
