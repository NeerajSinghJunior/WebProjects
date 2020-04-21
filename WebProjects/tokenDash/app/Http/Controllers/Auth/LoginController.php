<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Notifications\socialPassword;
use Socialite;
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

    use AuthenticatesUsers {
        attemptLogin as attemptLoginAtAuthenticatesUsers;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $settings=Admin::select('captcha_key', 'site_logo', 'site_title', 'fav_ico')->first();
        // dd($captcha);
        return view('auth.login')->with('settings',$settings);
    }

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
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Returns field name to use at login.
     *
     * @return string
     */
    public function username()
    {
        return config('auth.providers.users.field', 'email');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {

        if(isset($captcha) && $captcha->captcha_key != ''){

        $request->validate([
            'g-recaptcha-response'=>'required|recaptcha'
        ]);

    }

        if ($this->username() === 'email') {
            return $this->attemptLoginAtAuthenticatesUsers($request);
        }
        if (! $this->attemptLoginAtAuthenticatesUsers($request)) {
            return $this->attempLoginUsingUsernameAsAnEmail($request);
        }
        return false;
    }

    /**
     * Attempt to log the user into application using username as an email.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attempLoginUsingUsernameAsAnEmail(Request $request)
    {
        return $this->guard()->attempt(
            ['email' => $request->input('username'), 'password' => $request->input('password')],
            $request->has('remember')
        );
    }
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider){
        $user = Socialite::driver($provider)->user();
        $authUser = User::where('email', $user->email)->first();
        if(!$authUser) {
            $password = time();
            $authUser =  User::create([
                'email' => $user->email,
                'name' => $user->name,
                'phone' => isset($user->phone) ? $user->phone : '',
                'password' =>  bcrypt($password),
                'verified' => 1
            ]);
            $authUser->notify(new socialPassword($password));
        }
        $this->guard()->login($authUser);
        return redirect('home');
    }
}
