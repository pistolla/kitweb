<?php

namespace App\Http\Controllers;

use Auth;
use App\Plan;
use App\User;
use App\Admin;
use App\Adtype;
use App\Deposit;
use App\Gateway;
use App\General;
use App\Wmethod;
use App\Withdraw;
use App\Advertise;
use App\Publisher;
use App\Subscribe;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('status',1)->count();
        $withdraw = Withdraw::where('status',0)->count();
        $deposit = Deposit::where('status',1)->sum('amount');
        $pub = Publisher::count();
        $advertises = Advertise::orderBy('id','desc')->paginate(15);
        $views = Advertise::where('status',1)->sum('count_imp');
        $click = Advertise::where('status',1)->sum('count_click');
        $ads = Advertise::where('status',1)->count();
        $pt = 'DASHBOARD';
        return view('admin.dashboard', compact('users','withdraw','deposit','pub','advertises','pt','views','click','ads'));
    }

    public function subscribers()
    {
        $subs = Subscribe::all();
        $pt = 'SUBSCRIBERS';
        return view('admin.users.subscribers', compact('subs','pt'));
    }

    public function subsEmail(Request $request)
    {
        $this->validate($request,
            [
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);

        $subs = Subscribe::all();

        foreach ($subs as $user)
        {

         $to = $user->email;
         $name = $user->name;
         $subject = $request->subject;
         $message = $request->emailMessage;

         send_email($to, $name, $subject, $message);
        }

        return back()->withSuccess('Mail Sent Successfuly');
    }

    public function subscriberDelete($id)
    {
        $sub = Subscribe::find($id);
        $sub->delete();
        return back()->withSuccess('Subscriber Mail Delete Successfuly');
    }


    //Advertisement type
    public function adtypes()
    {
        $adtypes = Adtype::all();
        $pt = 'Advertisement TYPES';
        return view('admin.ads.types', compact('adtypes','pt'));
    }

    public function adStore(Request $req)
    {
        $this->validate($req, ['name' => 'required','photo' => 'required', 'type' => 'required', 'width' => 'required|numeric', 'height' => 'required|numeric']);

        $type['name'] = $req->name;
        $type['type'] = $req->type;
        $type['width'] = $req->width;
        $type['height'] = $req->height;
        $type['slag'] = $req->width.'x'.$req->height;
        $type['status'] = 1;
               
        if($req->hasFile('photo'))
        {
            if($req->photo->getClientOriginalExtension() == 'jpeg' || $req->photo->getClientOriginalExtension() == 'png' || $req->photo->getClientOriginalExtension() == 'jpg' || $req->photo->getClientOriginalExtension() == 'gif' )
            {
                $width = Image::make($req->photo)->width();
                $height = Image::make($req->photo)->height();
                if($req->width == $width && $req->height == $height)
                {
                    $photo = 'assets/ads/'.$type['slag'].'.png';
                    Image::make($req->photo)->save($photo);

                }
                else
                {
                    return back()->with('alert', 'Invalid File Size');
                }
              
            }
            else
            {
                return back()->with('alert', 'Invalid Extension');
            }
        }
        Adtype::create($type);
        return back()->with('success','New Advertisement Type Created');

    }
   
    public function adUpdate(Request $req, Adtype $adtype)
    {
        $this->validate($req, ['name' => 'required', 'type' => 'required', 
        'width' => 'required|numeric', 
        'height' => 'required|numeric']);
        
        $adtype['name'] = $req->name;
        $adtype['type'] = $req->type;
        $adtype['width'] = $req->width;
        $adtype['height'] = $req->height;
        $adtype['slag'] =$req->width.'x'.$req->height;
        $adtype['status'] = $req->status;
                
        if($req->hasFile('photo'))
        {
            if($req->photo->getClientOriginalExtension() == 'jpeg' || $req->photo->getClientOriginalExtension() == 'png' || $req->photo->getClientOriginalExtension() == 'jpg' || $req->photo->getClientOriginalExtension() == 'gif' )
            {
                $width = Image::make($req->photo)->width();
                $height = Image::make($req->photo)->height();
                if($req->width == $width && $req->height == $height)
                {
                    $photo = '/ads/'.$adtype['slag'].'.png';
                    Image::make($req->photo)->save($photo);

                }
                else
                {
                    return back()->with('alert', 'Invalid File Size');
                }
              
            }
            else
            {
                return back()->with('alert', 'Invalid Extension');
            }
        }
        $adtype->update();
        return back()->with('success','Advertisement Type Updated');
    }
    //Advertisement type
   
    //Advertisement Plan
    public function planindex()
    {
        $plans = Plan::all();
        $pt = 'Advertisement Plans';
        return view('admin.ads.plans', compact('plans','pt'));
    }

    public function planStore(Request $req)
    {
        $this->validate($req, ['name' => 'required', 'credit' => 'required|numeric', 'price' => 'required', 'type' => 'required']);

        $plan['name'] = $req->name;
        $plan['credit'] = $req->credit;
        $plan['price'] = $req->price;
        $plan['type'] = $req->type;
        $plan['status'] = 1;
        Plan::create($plan);

        return back()->with('success','New Advertisement Plan Created');

    }
   
    public function planUpdate(Request $req, Plan $plan)
    {
        $this->validate($req, ['name' => 'required', 'credit' => 'required|numeric', 'price' => 'required', 'type' => 'required']);


        $plan['name'] = $req->name;
        $plan['credit'] = $req->credit;
        $plan['price'] = $req->price;
          $plan['type'] = $req->type;
        $plan['status'] = $req->status;
        $plan->update();

        return back()->with('success','Advertisement Plan Updated');
    }
    //Advertisement Plan
    
           
    public function general()
    {
        $general = General::first();
        if(is_null($general))
        {
            $default = [
                'title' => 'THESOFTKING',
                'subtitle' => 'Subtitle',
                'color' => '009933',
                'cur' => 'BDT',
                'cursym' => 'TK',
                'decimal' => 2,
                'reg' => 1,
                'emailver' => 0,
                'smsver' => 1,
                'emailnotf' => 0,
                'smsnotf' => 1
            ];
            General::create($default);
            $general = General::first();
        }
        $pt = 'GENERAL SETTINGS';
        
        return view('admin.website.general', compact('general','pt'));
    }
        
    public function generalUpdate(Request $request)
    {
        $general = General::first();
        
        $this->validate($request,
        [
            'title' => 'required',
            'subtitle' => 'required',
            'color' => 'required',
            'cur' => 'required',
            'view' => 'required',
            'click' => 'required',
            'cursym' => 'required',
            'decimal' => 'required',
            ]);
        
        $general['title'] = $request->title;
        $general['subtitle'] = $request->subtitle;
        $general['color'] = ltrim($request->color,'#');
        $general['cur'] = $request->cur;
        $general['view'] = $request->view;
        $general['click'] = $request->click;
        $general['cursym'] = $request->cursym;
        $general['decimal'] = $request->decimal;
        $general['reg'] = $request->reg =="1" ?1:0 ;
        $general['emailver'] = $request->emailver =="1" ?0:1 ;
        $general['smsver'] = $request->smsver =="1" ?0:1 ;
        $general['emailnotf'] = $request->emailnotf=="1" ?1:0;
        $general['smsnotf'] = $request->smsnotf=="1" ?1:0;
        $general->update();
        
        return back()->with('success', 'General Settings Updated Successfully!');
    }
        
        
    public function logoIcon()
    {
        $pt = 'LOGO & ICON SETTINGS';
        return view('admin.website.logo',compact('pt'));
    }
        
    public function logoUpdate(Request $request)
    {
        $this->validate($request, [
            'logo' => 'image|mimes:jpeg,png,jpg|max:4048',
            'icon' => 'image|mimes:jpeg,png,jpg|max:4048',         
            'bread' => 'image|mimes:jpeg,png,jpg|max:8048',         
            ]);
            
        if($request->hasFile('logo'))
        {
            Image::make($request->logo)->save('/images/logo/logo.png');
        }
        if($request->hasFile('icon'))
        {
            Image::make($request->icon)->resize(128, 128)->save('/images/logo/icon.png');
        }
        if($request->hasFile('bread'))
        {
            Image::make($request->bread)->save('/ads/default.jpg');
        }
        
        return back()->with('success','Logo and Icon, Default Ad Updated successfully.');
    }
            
    public function emailSms()
    {
        $temp = General::first();
        $pt = 'TEMPLATE SETTINGS';
        return view('admin.website.template', compact('temp','pt'));
    }
                
    public function emailUpdate(Request $request)
    {
        $temp = General::first();
        
        $this->validate($request,['email' => 'email']);
            
        $temp['email'] = $request->email;
        $temp['template'] = $request->template;
        $temp['smsapi'] = $request->smsapi;
        $temp->save();
            
        return back()->with('success', 'Email and SMS Settings Updated Successfully!');
    }

    //User Manage
    public function userIndex()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        $pt = 'USER LIST';
        return view('admin.users.index', compact('users','pt'));
    } 
    
    public function userSearch(Request $request)
    {
        $this->validate($request, [ 'search' => 'required' ]);
        
        $users = User::where('username', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->get();
        $key = $request->search;
        $pt = 'USER SEARCH RESULT';
        return view('admin.users.search', compact('users','key','pt'));
        
    }
    
    public function singleUser($id)
    {
        $user = User::findOrFail($id);
        $pt = $user->name;
        return view('admin.users.single', compact('user','pt'));
    }
       
    public function email($id)
    {
        $user = User::findorFail($id);
        $pt = 'SEND EMAIL';
        return view('admin.users.email',compact('user','pt'));
    }

    public function userPasschange(Request $request,$id)
    {
        $user = User::find($id);
        
        $this->validate($request,['password' => 'required|string|min:6|confirmed']);
        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
            $user->save();
            
            $msg =  'Password Changed By Admin. New Password is: '.$request->password;
            send_email($user->email, $user->username, 'Password Changed', $msg);
            $sms =  'Password Changed By Admin. New Password is: '.$request->password;
            send_sms($user->mobile, $sms);
            
            return back()->with('success', 'Password Changed');
        }
        else 
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }

    public function statupdate(Request $request,$id)
    {
        $user = User::find($id);
        
        $this->validate($request, [ 'name' => 'required|string|max:255',  'email' => 'required|string|max:255', 'mobile' => 'required|string|max:255',]);
            
            $user['name'] = $request->name ;
            $user['mobile'] = $request->mobile;
            $user['email'] = $request->email;
            $user['status'] = $request->status =="1" ?1:0;
            $user['emailv'] = $request->emailv =="1" ?1:0;
            $user['smsv'] = $request->smsv =="1" ?1:0;
            $user['tauth'] = $request->tauth =="1" ?1:0;
            
            $user->save();
            
            $msg =  'Your Profile Updated by Admin';
            send_email($user->email, $user->username, 'Profile Updated', $msg);
            $sms =  'Your Profile Updated by Admin';
            send_sms($user->mobile, $sms);
            
            return back()->withSuccess('User Profile Updated Successfuly');
        }
        
        public function bannedUser()
        {
            $users = User::where('status', '0')->orderBy('id', 'desc')->paginate(10);
            $pt = 'BANNED USERS';
            return view('admin.users.banned', compact('users','pt'));
        }
        
      
    //User Manage
   
    public function gateway()
    {
        $gateways = Gateway::all();
        $pt = 'PAYMENT GATEWAY';
        return view('admin.website.gateway', compact('gateways','pt'));
    }

     
    public function gatewayUpdate(Request $request, Gateway $gateway)
    {
        $this->validate($request, ['gateimg' => 'image|mimes:jpeg,png,jpg|max:2048','name' => 'required']);
        
        if($request->hasFile('gateimg'))
        {
            $imgname = $gateway->id.'.jpg';
            $npath = '/images/gateway/'.$imgname;
            Image::make($request->gateimg)->resize(200, 200)->save($npath);
        }
        
        $gateway['name'] = $request->name;
        $gateway['minamo'] = $request->minamo;
        $gateway['maxamo'] = $request->maxamo;
        $gateway['fixed_charge'] = $request->fixed_charge;
        $gateway['percent_charge'] = $request->percent_charge;
        $gateway['rate'] = $request->rate;
        $gateway['val1'] = $request->val1;
        $gateway['val2'] = $request->val2;
        $gateway['status'] = $request->status;
        $gateway->update();
        
        return back()->with('success','Gateway Information Updated Successfully');
    }
    
    
    public function wmethod()
    {
        $gateways = Wmethod::all();
        $pt = 'WITHDRAW METHOD';
        return view('admin.website.wmethod', compact('gateways','pt'));
    }
           
    public function wmethodCreate(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        
            
        $wmethod['name'] = $request->name;
        $wmethod['minamo'] = $request->minamo;
        $wmethod['maxamo'] = $request->maxamo;
        $wmethod['fixed_charge'] = $request->fixed_charge;
        $wmethod['percent_charge'] = $request->percent_charge;
        $wmethod['rate'] = $request->rate;
        $wmethod['val1'] = $request->val1;
        $wmethod['status'] = $request->status;
        Wmethod::create($wmethod);
        
        return back()->with('success','Withdraw Method Created Successfully');
    }

    public function wmethodUpdate(Request $request, Wmethod $wmethod)
    {
        $this->validate($request,  ['name' => 'required']);
        
        $wmethod['name'] = $request->name;
        $wmethod['minamo'] = $request->minamo;
        $wmethod['maxamo'] = $request->maxamo;
        $wmethod['fixed_charge'] = $request->fixed_charge;
        $wmethod['percent_charge'] = $request->percent_charge;
        $wmethod['rate'] = $request->rate;
        $wmethod['val1'] = $request->val1;
        $wmethod['status'] = $request->status;
        $wmethod->update();
        
        return back()->with('success','Withdraw Method Updated Successfully');
    }
                        
    public function sendemail(Request $request)
    {
        $this->validate($request,
        [   'emailto' => 'required|email',
            'reciver' => 'required',
            'subject' => 'required',
            'emailMessage' => 'required'
            ]);
        $to = $request->emailto;
        $name = $request->reciver;
        $subject = $request->subject;
        $message = $request->emailMessage;
        
        send_email($to, $name, $subject, $message);
        
        return back()->withSuccess('Mail Sent Successfuly');
            
    }
        
    public function broadcast()
    {   
        $pt = 'BROADCAST EMAIL';
        return view('admin.users.broadcast',compact('pt'));
    }
                            
    public function broadcastemail(Request $request)
    {
        $this->validate($request,[ 'subject' => 'required','emailMessage' => 'required']);
    
        if($request->aud==1)
        {
            $users = User::where('status', '1')->get();
        
            foreach ($users as $user)
            {
                
                $to = $user->email;
                $name = $user->name;
                $subject = $request->subject;
                $message = $request->emailMessage;
                
                send_email($to, $name, $subject, $message);
            }
        }
        else
        {
            $publishers = Publisher::where('status', '1')->get();
        
            foreach ($publishers as $pb)
            {
                
                $to = $pb->email;
                $name = $pb->name;
                $subject = $request->subject;
                $message = $request->emailMessage;
                
                send_email($to, $name, $subject, $message);
            }
        
        }
       
       
        return back()->withSuccess('Broadcast Mail Sent Successfuly');
    }
                                
   
   
    public function deposits()
    {
        $deposits = Deposit::orderBy('id','DESC')->paginate(15);
        $pt = 'DEPOSITS';
        return view('admin.users.deposits', compact('deposits','pt'));
    }
    
    public function withdrawRequest()
    {
        $reqs = Withdraw::where('status',0)->paginate(20);
        $pt = 'WITHDRAW REQUEST';
        return view('admin.users.withreqs', compact('reqs','pt'));
    }
    public function withdrawLog()
    {
        $logs = Withdraw::where('status',1)->paginate(20);
        $pt = 'WITHDRAW LOG';
        return view('admin.users.withlog', compact('logs','pt'));
    }
    public function withdrawApprove(Request $request, $id)
    {
        $withd = Withdraw::findOrFail($id);
        $withd['status'] = 1;
        $withd->update();
        
        return back()->with('success','Withdraw Approved Successfully');
    }
    public function withdrawCancel(Request $request, $id)
    {
        $withd = Withdraw::findOrFail($id);
        $withd['status'] = 2;
        $withd->update();
        
        $user = Publisher::find($withd->publisher_id);
        $user['balance'] = $user->balance + $withd->amount;
        $user->update();
        
        return back()->with('success','Withdraw Canceled Successfully');
    }
                
    public function changePassword()
    {
        $pt = 'CHANGE PASSWORD';
        return view('admin.auth.changepass',compact('pt'));
    }
    
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        if(Hash::check($request->passwordold, $admin->password) && $request->password == $request->password_confirmation)
        {
            $admin['password'] =  Hash::make($request->password);
            $admin->save();
            return back()->with('success', 'Password Changed');
        }
        else 
        {
            return back()->with('alert', 'Password Not Changed');
        }
    }
    public function newAdmin()
    {
        $pt = 'NEW ADMIN REGISTRATION';
        return view('admin.auth.newadmin',compact('pt'));
    }
                
    public function listAdmin()
    {
        $admins = Admin::all();
        $pt = 'ADMIN LIST';
        return view('admin.auth.adminlist', compact('admins','pt'));
    }
                
    public function createAdmin(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:admins',
            'username' => 'required|string|max:191|unique:admins|alpha_dash',
            'password' => 'required|string|min:5|confirmed',
        ]);
        
        $admin['name'] = $request->name;
        $admin['email'] = $request->email;
        $admin['username'] = $request->username;
        $admin['password'] = Hash::make($request->password);
        Admin::create($admin);
        
        return back()->with('success', 'New Admin Created Successfully');
    }     
    public function deleteAdmin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        if($admin->id==1)
        {
            return back()->with('alert', 'Super Admin Can Not Be Removed');
        }
        else
        {
            $admin->delete();
            return back()->with('success', 'New Admin Removed Successfully');
        }
      
    }     
    
    

    //Admin Authentication
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
        'username'   => 'required',
        'password' => 'required'
        ]);
            
        if (Auth::guard('admin')->attempt(['username' => $request->username, 
        'password' => $request->password])) 
        {
            if(Auth::guard('web')->check()){Auth::guard('web')->logout();}
            if(Auth::guard('publisher')->check()){Auth::guard('publisher')->logout();}
            return redirect()->intended(route('admin.dashboard'));
        } 
        return redirect()->back()->with('alert','Username and Password Not Matched');
    }
        
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->intended(route('user.index'));
    }
    //Admin Authentication
    


    //Publisher Manage
    public function publisherIndex()
    {
        $users = Publisher::orderBy('id', 'desc')->paginate(15);
        $pt = 'Publisher LIST';
        return view('admin.publisher.index', compact('users','pt'));
    } 
    
    public function publisherSearch(Request $request)
    {
        $this->validate($request, [ 'search' => 'required' ]);
        
        $users = Publisher::where('username', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->get();
        $key = $request->search;
        $pt = 'Publisher SEARCH RESULT';
        return view('admin.publisher.search', compact('users','key','pt'));
        
    }
    
    public function singlePublisher($id)
    {
        $user = Publisher::findOrFail($id);
        $pt = $user->name;
        return view('admin.publisher.single', compact('user','pt'));
    }
       
    public function emailPublisher($id)
    {
        $user = Publisher::findorFail($id);
        $pt = 'SEND EMAIL';
        return view('admin.publisher.email',compact('user','pt'));
    }

    public function publisherPasschange(Request $request,$id)
    {
        $user = Publisher::find($id);
        
        $this->validate($request,['password' => 'required|string|min:6|confirmed']);
        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
            $user->save();
            
            $msg =  'Password Changed By Admin. New Password is: '.$request->password;
            send_email($user->email, $user->username, 'Password Changed', $msg);
            $sms =  'Password Changed By Admin. New Password is: '.$request->password;
            send_sms($user->mobile, $sms);
            
            return back()->with('success', 'Password Changed');
        }
        else 
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }

    public function statupdatePublisher(Request $request,$id)
    {
        $user = Publisher::find($id);
        
        $this->validate($request, [ 'name' => 'required|string|max:255',  'email' => 'required|string|max:255', 'mobile' => 'required|string|max:255',]);
            
        $user['name'] = $request->name ;
        $user['mobile'] = $request->mobile;
        $user['email'] = $request->email;
        $user['status'] = $request->status =="1" ?1:0;
        $user['emailv'] = $request->emailv =="1" ?1:0;
        $user['smsv'] = $request->smsv =="1" ?1:0;
        $user['tauth'] = $request->tauth =="1" ?1:0;
        $user->save();
        
        $msg =  'Your Profile Updated by Admin';
        send_email($user->email, $user->username, 'Profile Updated', $msg);
        $sms =  'Your Profile Updated by Admin';
        send_sms($user->mobile, $sms);
        
        return back()->withSuccess('User Profile Updated Successfuly');
    }
    
    public function bannedPublisher()
    {
        $users = Publisher::where('status', '0')->orderBy('id', 'desc')->paginate(10);
        $pt = 'BANNED Publishers';
        return view('admin.publisher.banned', compact('users','pt'));
    }
    //Publisher Manage
}
                                                