<?php

namespace App\Http\Controllers;

use Auth;
use App\Adtype;
use App\General;
use App\Wmethod;
use App\Analytic;
use App\Password;
use App\Withdraw;
use App\Publisher;
use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PublisherController extends Controller
{
    public function dashboard()
    {
        $pt = 'Dashboard';
        $impression = Analytic::where('publisher_id', Auth::guard('publisher')->user()->id)->where('type',1)->count();
        $click = Analytic::where('publisher_id', Auth::guard('publisher')->user()->id)->where('type',2)->count();
        $withds = Withdraw::where('publisher_id',Auth::guard('publisher')->user()->id)->orderBy('id','DESC')->paginate(10);
        return view('publisher.dashboard', compact('pt','impression','click','withds'));
    }
    public function getAds()
    {
        $pt = 'Type of Advertisements';
        $types = Adtype::where('status',1)->get();
        $pubid = Auth::guard('publisher')->user()->id;
        return view('publisher.adtypes', compact('pt','types','pubid'));
    }
    
    
    public function withdraw()
    {
        $gates = Wmethod::where('status',1)->get();
        $pt = 'Withdraw';
        return view('publisher.withdraw', compact('gates','pt'));
    }

    public function withdrawPost(Request $request)
    {
        $this->validate($request,
        [
        'amount' => 'required',
        'account' => 'required',
        'gateway' => 'required',
        ]);
        
        $method = Wmethod::findOrFail($request->gateway);

        $charge = $method->fixed_charge + ($request->amount*$method->percent_charge/100);
        $amount = $request->amount + $charge;

        if($amount > Auth::user()->balance || $request->amount<=0 ||  $amount < $method->minamo ||  $amount > $method->maxamo)
        {
            return back()->with('alert', 'Invalid Amount');
        }
        else
        {
            $publisher = Publisher::find(Auth::guard('publisher')->user()->id);
            $publisher['balance'] = $publisher->balance - $amount;
            $publisher->update();
            
            $with['publisher_id'] = $publisher->id;
            $with['wmethod_id'] = $method->id;
            $with['amount'] = $request->amount;
            $with['account'] = $request->account;
            $with['status'] = 0;
            Withdraw::create($with);
    
            return back()->with('success', 'Withdraw Request Sent Successfully!');
        }
     
        
    }

    public function userProfileData()
    {
        $user = Publisher::find(Auth::guard('publisher')->user()->id);
        $pt = 'My Profile';
        return view('publisher.profile', compact('user','pt'));
    }
    
    public function updateProfile(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'city' => 'required'
        ]);
        $user = Publisher::find(Auth::guard('publisher')->user()->id);
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['mobile'] = $request->mobile;
        $user['country'] = $request->country;
        $user['city'] = $request->city;
        $user->update();
        return back()->with('success', 'Profile Data Updated');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,
        [
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = Publisher::find(Auth::guard('publisher')->user()->id);
        if($request->password == $request->password_confirmation)
        {
            $user['password'] = Hash::make($request->password);
            $user->update();

            return back()->with('success', 'Password Changed');
        }
        else 
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }


    //Publisher Authentication
    public function showLoginForm()
    {
        return view('publisher.auth.login');
    }

    public function publisherVerifaction()
    {
        if(Auth::guard('publisher')->user()->status == '1' && Auth::guard('publisher')->user()->emailv == 1 && Auth::guard('publisher')->user()->smsv == 1)
        {
            return redirect()->route('publisher.dashboard');
        }
        else
        {
            return view('publisher.auth.verify');
        }
    }

    public function showRegistrationForm()
    {   
       $gnl = General::first();
       if(1 == $gnl->reg)
       {
            $countries = Country::all();
           return view('publisher.auth.register', compact('countries'));
       }
       else
       {
           return redirect()->route('user.index')->with('alert', 'Registration Closed Now');
       }
    }

    public function register(Request $request)
    {
       $this->validate($request, [
       'name' => 'required|string|max:255',
       'email' => 'required|string|email|max:255|unique:publishers',
       'username' => 'required|alpha_num|max:25|unique:publishers|alpha_dash',
       'password' => 'required|string|min:6|confirmed',
       'country' => 'required|string|max:255',
       'city' => 'required|string|max:255',
       'mobile' => 'required|string',
       ]);
       $gnl = General::first();
       
       if(1 == $gnl->reg)
       {
           $reg['name'] = $request->name;
           $reg['email'] = $request->email;
           $reg['username'] = $request->username;
           $reg['password'] = Hash::make($request->password);
           $reg['country'] = $request->country;
           $reg['city'] = $request->city;
           $reg['mobile'] = $request->mobile;
           $reg['emailv'] = $gnl->emailver;
           $reg['smsv'] = $gnl->smsver;
           Publisher::create($reg);

           if (Auth::guard('publisher')->attempt(['username' => $request->username, 
           'password' => $request->password])) 
           {
               return redirect()->route('publisher.dashboard');
           }
           else
           {
               return redirect()->route('publisher.register')->with('alert', 'Failed to Register');
           }
       }

    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
        'username'   => 'required',
        'password' => 'required'
        ]);
           
       
       if(Auth::guard('publisher')->attempt(['username' => $request->username, 'password' => $request->password])) 
        {
           return redirect()->route('publisher.dashboard');
        }
        else
        {
           return redirect()->route('publisher.login')->with('alert','Username and Password Not Matched');
        } 

    }

    public function logout(Request $request)
    {
        Auth::guard('publisher')->logout();
        $request->session()->invalidate();
        return redirect()->intended(route('user.index'));
    }

 
    public function sendVcode(Request $request)
    {
        $pulisher = Publisher::find(Auth::guard('publisher')->user()->id);
        $chktm =$pulisher->vsent+1000;
        if ($chktm > time())
        {
        $delay = $chktm-time();
        return back()->with('alert', 'Please Try after '.$delay.' Seconds');
        }
        else
        {
            $email = $request->email;
            $mobile = $request->mobile;
            $code = str_random(8);
            $msg = 'Your Verification code is: '.$code;
            $pulisher['vercode'] = $code ;
            $pulisher['vsent'] = time();
            $pulisher->update();

            if(isset($email))
            {
                send_email($pulisher->email,$pulisher->username, 'Verification Code', $msg);
                return back()->with('success', 'Email verification code sent succesfully');
            }
            elseif(isset($mobile))
            {
                send_sms($pulisher->mobile, $msg);
                return back()->with('success', 'SMS verification code sent succesfully');
            }
            else
            {
                return back()->with('alert', 'Sending Failed');
            }
        
        }

    }
 
    public function emailVerify(Request $request)
    {
        $this->validate($request, [ 'code' => 'required' ]);
        $pulisher = Publisher::find(Auth::guard('publisher')->user()->id);
        $code = $request->code;

        if ( $pulisher->vercode == $code)
        {
        $pulisher['emailv'] = 1;
        $pulisher['vercode'] = str_random(10);
        $pulisher['vsent'] = 0;
        $pulisher->save();

            return redirect()->route('publisher.dashboard')->with('success', 'Email Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function smsVerify(Request $request)
    {
        $this->validate($request, ['code' => 'required']);
        $pulisher = Publisher::find(Auth::guard('publisher')->user()->id);
        $code = $request->code;

        if( $pulisher->vercode == $code)
        {
        $pulisher['smsv'] = 1;
        $pulisher['vercode'] = str_random(10);
        $pulisher['vsent'] = 0;
        $pulisher->save();

            return redirect()->route('publisher.dashboard')->with('success', 'Mobile Number Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }
 
    public function resetEmail()
    {
        return view('publisher.auth.passwords.email');
    }
 
    public function sendEmail(Request $request)
    {
        $this->validate($request, ['email'   => 'required']);
        
        $efind = Publisher::where('email', $request->email)->first();

        if(isset($efind))
        {
            $code = str_random(32);
            $pass['email'] = $request->email;
            $pass['token'] = $code;
            $pass['status'] = 0;
            Password::create($pass);
    
            $to = $request->email;
            $name = 'User';
            $subject = 'Reset Password';
            $message = 'Use This Link to Reset Password: '.url('/').'/'.'password-reset'.'/'.$code;
        
            send_email($to, $name, $subject, $message);
            
            return back()->withSuccess('Mail Sent Successfuly');
        }
        else
        {
            return back()->withAlert('Invalid Email Address');
        }
        
    
    }
 
    public function resetForm($token)
    {
        $now = Carbon::now();
        $tval = Password::where('token', $token)->where('status',0)->where('created_at', '>', $now->subMinutes(30))->first();

        if(isset($tval))
        {   
            $pulisher = Publisher::where('email', $tval->email)->first();
            $username =$pulisher->username;
            return view('publisher.auth.passwords.reset', compact('username','token'));
        }
        else
        {
            return redirect()->route('publisher.login')->withAlert('Invalid Token');;
        }
        
    }
 
    public function resetPassword(Request $request)
    {
        $this->validate($request, ['token' => 'required','password' => 'required','password_confirmation' => 'required']);
        $now = Carbon::now();
        $reset = Password::where('token', $request->token)->where('status',0)->where('created_at', '>', $now->subMinutes(30))->first();
        if(isset($reset)) 
        {
        $pulisher = Publisher::where('email', $reset->email)->first();

            if($request->password == $request->password_confirmation)
            {
                $pulisher['password'] = Hash::make($request->password);
                $pulisher->update();

                $reset['status'] = 1;
                $reset->update();

                $msg =  'Password Changed Successfully';
                send_email( $pulisher->email,$pulisher->username, 'Password Changed', $msg);
                $sms =  'Password Changed Successfully';
                send_sms( $pulisher->mobile, $sms);

                return redirect()->route('publisher.login')->with('success', 'Password Changed');
            }
            else 
            {
                return back()->with('alert', 'Password Not Matched');
            }
            
        }
        else
        {
            return redirect()->route('publisher.login')->with('alert', 'Invalid Reset Link');
        }
    }
     //Publisher Authentication

}
