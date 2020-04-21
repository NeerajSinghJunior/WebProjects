<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Jrean\UserVerification\Facades\UserVerification;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Validator;
use App\Rules\Captcha;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
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

    use VerifiesUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $captcha = Admin::select('captcha_key')->first();
        return view('auth.register')->with('captcha', $captcha);
    }

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
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
            'name' => 'required|max:255',
            'country_code' => 'required',
            'country' => 'required',
            'username' => 'sometimes|required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required',
            'ether' => 'required',
            'g-recaptcha-response' => new Captcha()
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $fields = [
            'name' => $data['name'],
            'country' => $data['country'],
            'email' => $data['email'],
            'phone' => '+'.$data['country_code'].$data['phone'],
            'ether' => $data['ether'],
            'password' => bcrypt($data['password']),
            'referral_code' => 'REF' . time(),
        ];
        if ($data['referred_by']) {
            $fields['referred_by'] = $data['referred_by'];
        }

        if (config('auth.providers.users.field', 'email') === 'username' && isset($data['username'])) {
            $fields['username'] = $data['username'];
        }
        return User::create($fields);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user));

        $this->guard()->login($user);

        UserVerification::generate($user);

        UserVerification::send($user, 'ICODash Coin Email Verification');

        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());

    }
}
