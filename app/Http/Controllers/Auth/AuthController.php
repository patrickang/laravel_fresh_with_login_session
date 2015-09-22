<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get Login Page
     * Redirects if already logged in
     * @return view 
     */
    public function getLogin()
    {
        if (Session::has('_user')) {
            return redirect('/dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handles submitting login form
     * @param  Request $request 
     * @return redirect           
     */
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->input(),
                [
                    'username' => 'required',
                    'password' => 'required'
                ]
            );
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator->messages())->withInput();
        }
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::where(['username' => $username, 'password' => md5($password)])->first();
        if (!$user) {
            return redirect('/')->withErrors('Invalid Login Credentials')->withInput();
        }
        Session::put('_user',$username);
        return redirect('/');
    }

    /**
     * Logouts the user
     * @return redirect 
     */
    public function getLogout()
    {
        Session::flush();

        return redirect('/');
    }

    /**
     * Get Register Page
     * @return view 
     */
    public function getRegister()
    {
        if (Session::has('_user')) {
            return redirect('/dashboard');
        }

        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $validator = validator::make($request->input(),
                [
                    'username' => 'required|unique:users',
                    'password' => 'required'
                ]
            );
        if ($validator->fails()) {
            return redirect('/auth/register')->withErrors($validator->errors())->withInput();
        }

        User::create(['username' => $request->input('username'), 'password' => md5($request->input('password'))]);
        Session::put('_user',$request->input('username'));
        return redirect('/');
    }

}
