<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\General;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/login';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|alpha_num|max:20|unique:users|alpha_dash',
            'password' => 'required|string|min:6|confirmed',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'mobile' => 'required|string',
            'codehidden' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $gnl = General::first();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'country' => $data['country'],
            'city' => $data['city'],
            'mobile' => $this->_joinPhoneCode($data['codehidden'], $data['mobile']),
            'emailv' =>  $gnl->emailver,
            'smsv' =>  $gnl->smsver,
        ]);
    }

    private function _joinPhoneCode($code, $phone)
    {
        $tempPhone = $phone;
        if(!empty($code) && !empty($phone)){
            if(substr($phone, 0, 1) == '0'){
                $tempPhone = $code . substr($phone, 1, strlen($phone));
            } else if(substr($phone, 0, strlen($code)) == $code){
                $tempPhone = $code . substr($phone, 0, strlen($code));
            }
        }
        return $tempPhone;
    }

    public function showRegistrationForm() {
        $countries = Country::all();
        return view('auth.register', compact('countries'));
    }
}
