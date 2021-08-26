<?php
namespace App\Http\Controllers;

use Auth;
use App\Activity;
use App\Member;
use App\Like;
use App\Comment;
use App\Adtype;
use App\General;
use App\Wmethod;
use App\Analytic;
use App\Password;
use App\Withdraw;
use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CommunityController extends Controller
{
    public function dashboard(Request $req)
    {
        
        $activities = Activity::latest()->with(['member', 'comments', 'likes'])->paginate(50);
        $post = null;
        if($activities){
            $post = $activities->shift();
        }
        return view('feed.dashboard', compact('activities','post'));
    }

    public function enquireLatest(Request $req)
    {
        $lastId = $req->input('last_id');
        $search = $req->input('search');
        
        $activity = Activity::query()
        ->where('id', ' > ', $lastId)
        ->orWhere('details', 'LIKE', "%{$search}%")
        ->first();

        if($activity && !empty($activity)){
            return json_encode(
                [
                    "data" => true,
                    "activity_id" => $activity->id
                ]
            );
        } else {
            return json_encode(
                [
                    "data" => false,
                    "activity_id" => ""
                ]
            );
        }
    }

    public function fetchActivity($slug)
    {
        $post = Activity::where('slug', $slug)->with(['member', 'comments', 'likes', 'dislikes'])->first();
        $suggested = [];
        if(is_null($post)) {
            abort('404');
        }
            return view('feed.activity', compact('post', 'suggested'));
        
    }

    public function searchPost(Request $req)
    {
        $search = $req->input('search');
        $activities = Activity::query()
            ->where('heading', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->with(['member', 'comments', 'likes'])->paginate(20);
        $post = null;
        if($activities){
            $post = $activities->shift();
        }
        return view('feed.dashboard', compact('activities','post'));
    }

    public function createActivity(Request $request)
    {
        $this->validate(
            $request, [
            'heading' => 'required', 
            'details' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $post['heading'] = $request->heading;
        $post['details'] = $request->details;
        $post['member_id'] = $request->user()->id;
        $post['slug'] = str_replace(" ", "_", strtolower($request->heading));
        if($request->hasFile('photos') && !empty($request->file('photos')))
        {
            $images = [];
            if(is_array($request->file('photos'))){
                foreach ($request->file('photos') as $image) {
                    $fileName = uniqid().'.'.$image->getClientOriginalExtension();

                    $image->move(public_path() . '/images/community', $fileName);
    
                    $images[] = $fileName;
                }
            } else {
                $image = $request->file('photos');
                $fileName = uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(public_path() . '/images/community', $fileName);
    
                $images[] = $fileName;
            }
            $post['image_url'] = implode(";", $images);
        } elseif($request->has('link_url') && !empty($request->link_url))
        {
            $post['link_url'] = $request->link_url;
        }
        Activity::create($post);
        return back()->with('success','Your post is now available');
    }

    public function createComment(Request $req)
    {
        $this->validate($req, ['activity' => 'required', 'comment' => 'required']);
        $post['activity_id'] = $req->activity;
        $post['text'] = $req->comment;
        $post['member_id'] = $req->user()->id;

        Comment::create($post);
        return back()->with('success','Your have added a comment');
    }

    public function subscribe(Request $req)
    {

    }

    public function unsubscribe(Request $reqs)
    {
        
    }

    public function likeActivity( Request $request)
    {
        $this->validate($request, ['activity' => 'required']);
        $post = Activity::find($request->activity);
        if($post){
            if ($post->likedBy($request->user())) {
                return response(null, 409);
            }

            $post->likes()->create([
                'member_id' => $request->user()->id,
                'activity_id' => $request->activity
            ]);

            if (!$post->likes()->onlyTrashed()->where('member_id', $request->user()->id)->count()) {
                // Mail::to($post->member)->send(new PostLiked(auth()->user(), $post));
            }
        }

        return back();
    }

    public function dislikeActivity(Request $request)
    {
        $this->validate($request, ['activity' => 'required']);
        $request->user()->likes()->where('activity_id', $request->activity)->delete();

        return back();
    }

    public function likeComment(Request $request)
    {
        $this->validate($request, ['comment' => 'required']);
        $comment = Comment::find($request->comment);
        if($comment){
            if ($comment->likedBy($request->user())) {
                return response(null, 409);
            }

            $comment->likes()->create([
                'member_id' => $request->user()->id,
                'comment_id' => $comment->id,
            ]);

            if (!$comment->likes()->onlyTrashed()->where('member_id', $request->user()->id)->count()) {
                // Mail::to($post->member)->send(new PostLiked(auth()->user(), $post));
            }
        }

        return back();
    }

    public function dislikeComment(Request $request)
    {
        $this->validate($request, ['comment' => 'required']);
        $request->user()->likes()->where('commenty_id', $request->comment)->delete();

        return back();
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,
        [
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = Member::find(Auth::guard('feed')->user()->id);
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


    //Feed Authentication
    public function showLoginForm()
    {
        return view('feed.auth.login');
    }

    public function memberVerification()
    {
        if(Auth::guard('feed')->user()->status == '1' && Auth::guard('feed')->user()->emailv == 1 && Auth::guard('feed')->user()->smsv == 1)
        {
            return redirect()->route('feed.dashboard');
        }
        else
        {
            return view('feed.auth.verify');
        }
    }

    public function showRegistrationForm()
    {   
       $gnl = General::first();
       if(1 == $gnl->reg)
       {
           $countries = Country::all();
           return view('feed.auth.register', compact('countries'));
       }
       else
       {
           return redirect()->route('feed.dashboard')->with('alert', 'Registration Closed Now');
       }
    }

    public function register(Request $request)
    {
       $this->validate($request, [
       'name' => 'required|string|max:255',
       'email' => 'required|string|email|max:255|unique:members',
       'username' => 'required|alpha_num|max:25|unique:members|alpha_dash',
       'password' => 'required|string|min:6|confirmed',
       'country' => 'required|string|max:255',
       'city' => 'required|string|max:255',
       'mobile' => 'required|string',
       'codehidden' => 'required|string',
       ]
    );
       $gnl = General::first();
       
       if(1 == $gnl->reg)
       {
           $reg['name'] = $request->name;
           $reg['email'] = $request->email;
           $reg['username'] = $request->username;
           $reg['password'] = Hash::make($request->password);
           $reg['country'] = $request->country;
           $reg['city'] = $request->city;
           $reg['mobile'] = $this->_joinPhoneCode($request->codehidden, $request->mobile);
           $reg['emailv'] = $gnl->emailver;
           $reg['smsv'] = $gnl->smsver;
           Member::create($reg);

           if (Auth::guard('feed')->attempt(['username' => $request->username, 
           'password' => $request->password])) 
           {
               return redirect()->route('feed.dashboard');
           }
           else
           {
               return redirect()->route('feed.register')->with('alert', 'Failed to Register');
           }
       }

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
    
    public function login(Request $request)
    {
        $this->validate($request, [
        'username'   => 'required',
        'password' => 'required'
        ]);
           
       
       if(Auth::guard('feed')->attempt(['username' => $request->username, 'password' => $request->password])) 
        {
           return redirect()->route('feed.dashboard');
        }
        else
        {
           return redirect()->route('feed.login')->with('alert','Username and Password Not Matched');
        } 

    }

    public function logout(Request $request)
    {
        Auth::guard('feed')->logout();
        $request->session()->invalidate();
        return redirect()->intended(route('feed.dashboard'));
    }

 
    public function sendVcode(Request $request)
    {
        $member = Member::find(Auth::guard('feed')->user()->id);
        $chktm =$member->vsent+1000;
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
            $member['vercode'] = $code ;
            $member['vsent'] = time();
            $member->update();

            if(isset($email))
            {
                send_email($member->email,$member->username, 'Verification Code', $msg);
                return back()->with('success', 'Email verification code sent succesfully');
            }
            elseif(isset($mobile))
            {
                send_sms($member->mobile, $msg);
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
        $member = Member::find(Auth::guard('feed')->user()->id);
        $code = $request->code;

        if ( $member->vercode == $code)
        {
        $member['emailv'] = 1;
        $member['vercode'] = str_random(10);
        $member['vsent'] = 0;
        $member->save();

            return redirect()->route('feed.dashboard')->with('success', 'Email Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function smsVerify(Request $request)
    {
        $this->validate($request, ['code' => 'required']);
        $member = Member::find(Auth::guard('feed')->user()->id);
        $code = $request->code;

        if( $member->vercode == $code)
        {
        $member['smsv'] = 1;
        $member['vercode'] = str_random(10);
        $member['vsent'] = 0;
        $member->save();

            return redirect()->route('feed.dashboard')->with('success', 'Mobile Number Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }

    }
 
    public function resetEmail()
    {
        return view('feed.auth.passwords.email');
    }
 
    public function sendEmail(Request $request)
    {
        $this->validate($request, ['email'   => 'required']);
        
        $efind = Member::where('email', $request->email)->first();

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
            $member = Member::where('email', $tval->email)->first();
            $username =$member->username;
            return view('feed.auth.passwords.reset', compact('username','token'));
        }
        else
        {
            return redirect()->route('feed.login')->withAlert('Invalid Token');;
        }
        
    }
 
    public function resetPassword(Request $request)
    {
        $this->validate($request, ['token' => 'required','password' => 'required','password_confirmation' => 'required']);
        $now = Carbon::now();
        $reset = Password::where('token', $request->token)->where('status',0)->where('created_at', '>', $now->subMinutes(30))->first();
        if(isset($reset)) 
        {
        $member = Member::where('email', $reset->email)->first();

            if($request->password == $request->password_confirmation)
            {
                $member['password'] = Hash::make($request->password);
                $member->update();

                $reset['status'] = 1;
                $reset->update();

                $msg =  'Password Changed Successfully';
                send_email( $member->email,$member->username, 'Password Changed', $msg);
                $sms =  'Password Changed Successfully';
                send_sms($member->mobile, $sms);

                return redirect()->route('feed.login')->with('success', 'Password Changed');
            }
            else 
            {
                return back()->with('alert', 'Password Not Matched');
            }
        }
        else
        {
            return redirect()->route('feed.login')->with('alert', 'Invalid Reset Link');
        }
    }

    public function cityForCountryAjax($country_id)
    {
        $id = urldecode($country_id);
        $states = Country::join("states", "states.country_id", "=", "countries.id")
                    ->where("countries.id", $id)
                    ->get(['states.name','states.id', 'countries.phonecode']);
        return json_encode($states);
    }
}