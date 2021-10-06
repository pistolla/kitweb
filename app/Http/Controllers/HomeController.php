<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Plan;
use App\User;
use App\Adtype;
use App\Deposit;
use App\Gateway;
use App\Analytic;
use App\Withdraw;
use App\Advertise;
use App\Category;
use Carbon\Carbon;
use App\Country;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
       
    public function index()
    {
        $pt = "DASHBOARD";
        $impression = Analytic::where('user_id', Auth::id())->where('type',1)->count();
        $click = Analytic::where('user_id', Auth::id())->where('type',2)->count();
        $advs = Advertise::orderBy('id','DESC')->paginate(10);
        return view('user.home',compact('pt','impression','click','advs'));
    }

    public function transactionLog()
    {
        $pt = 'Transaction Log';
        $logs = Transaction::where('user_id',Auth::id())->orderBy('id','DESC')->paginate(10);
        return view('user.tlog', compact('pt','logs'));
    }
    
    public function deposit()
    {
        $pt = 'Deposit';
        $gates = Gateway::where('status',1)->get();
        $deposit = Deposit::where('user_id', Auth::id())->orderBy('id','DESC')->where('status',1)->paginate(15);
        $pending = Deposit::where('user_id', Auth::id())->orderBy('id','DESC')->where('status',0)->paginate(15);
        return view('user.deposit', compact('pt','gates','deposit', 'pending'));
    }

    public function depositDataInsert(Request $request)
    {
        $this->validate($request,['amount' => 'required','gateway' => 'required']);
        
        if($request->amount<=0)
        {
            return back()->with('alert', 'Invalid Amount');            
        }
        else
        {
            $gate = Gateway::findOrFail($request->gateway);
            
            if(isset($gate))
            {
                if($gate->minamo <= $request->amount || $gate->maxamo >= $request->amount)
                {
                    $charge = $gate->fixed_charge + ($request->amount*$gate->percent_charge/100);
                    $usdamo = ($request->amount + $charge)/$gate->rate;
                    
                    $depo['user_id'] = Auth::id();
                    $depo['gateway_id'] = $gate->id;
                    $depo['amount'] = $request->amount;
                    $depo['charge'] = $charge;
                    $depo['usd_amo'] = round($usdamo,2);
                    $depo['btc_amo'] = 0;
                    $depo['btc_wallet'] = "";
                    $depo['trx'] = uniqid(16);
                    $depo['try'] = 0;
                    $depo['status'] = 0;
                    Deposit::create($depo);
                    
                    Session::put('Track', $depo['trx']);
                    
                  return redirect()->route('deposit.preview');
                    
                }
                else
                {
                    return back()->with('alert', 'Please Follow Deposit Limit');
                }
            }
            else
            {
                return back()->with('alert', 'Please Select Deposit gateway');
            }
        }
        
    }
    
    public function depositPreview()
    {
        $track = Session::get('Track');
        
        $data = Deposit::where('status',0)->where('trx',$track)->first();
        $pt = 'Deposit Preview';
        
        return view('user.payment.preview',compact('pt','data'));
    }

    public function depositComplete(Request $request)
    {
        $this->validate($request,['trx' => 'required']);
        
        $data = Deposit::where('status',0)->where('trx',$request->trx)->first();
        $pt = 'Deposit Preview';
        
        return view('user.payment.preview',compact('pt','data'));
    }

    public function plans()
    {
        $plans = Plan::where('status',1)->get();
        $pt = "Advertisement Plans";

        return view('user.ads.plans', compact('pt','plans'));
    }
   
    public function getPlan(Request $request)
    {
        $this->validate($request,['plan' => 'required']);
        
      
        $plan = Plan::find($request->plan);
        
        if(isset($plan))
        {
            $user = User::find(Auth::id());
            if($plan->price <= $user->balance)
            {
                $user['balance'] = $user->balance - $plan->price;
                if($plan->type==1)
                {
                    $user['credit'] = $user->credit + $plan->credit;
                    
                }
                else
                {
                    $user['click'] = $user->click + $plan->credit;
                    
                }
                
                $user->update();
    
                $tlog['user_id'] = $user->id;
                $tlog['amount'] = $plan->price;
                $tlog['balance'] = $user->balance;
                $tlog['type'] = 0;
                $tlog['details'] =$plan->name.'Plan Purchased';
                $tlog['trxid'] = str_random(16);
                Transaction::create($tlog);
    
                return back()->with('success','Plan Purchased Successfuly');
            }
            else
            {
                 return back()->with('alert','Insufficient Balance');
            }
        }
        
    }

    public function advertise()
    {
        $types = Adtype::where('status',1)->get();
        $advs = Advertise::orderBy('id','DESC')->paginate(10);
        $adcategories = Category::orderBy('id')->get();
        $pt = "Advertisements";

        return view('user.ads.advertise', compact('pt','types','advs', 'adcategories'));
    }

    public function createAdvertise(Request $req)
    {
        $this->validate($req,['adcategory' => 'required', 'category' => 'required', 'description' => 'required', 'adtype' => 'required','amount' => 'required','link' => 'required','adfile' => 'required|image|mimes:jpeg,png,jpg,gif']);

        $type = Adtype::findOrFail($req->adtype);

        if($req->hasFile('adfile'))
        {
            if($req->adfile->getClientOriginalExtension() == 'jpeg' || $req->adfile->getClientOriginalExtension() == 'png' || $req->adfile->getClientOriginalExtension() == 'jpg' || $req->adfile->getClientOriginalExtension() == 'gif' )
            {
                $width = Image::make($req->adfile)->width();
                $height = Image::make($req->adfile)->height();
                if($type->width == $width && $type->height == $height)
                {
                    $filename = uniqid().'.'.$req->adfile->getClientOriginalExtension();
                    $path = '/images/ads/'. $filename;
                    //Image::make($req->adfile)->save($path);
                    $ad['photo'] =  "5bc32a8015d64.png";//$filename;
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
        $ad['user_id'] = Auth::id();
        $ad['adtype_id'] = $req->adtype;
        $ad['click'] = 1;
        $ad['total'] = $req->amount;
        $ad['link'] = $req->link;
        $ad['hashid'] = bin2hex(random_bytes(24));;
        $ad['status'] =  1;
        $ad['category_id'] =  $req->adcategory;
        $ad['category'] = $req->category;
        $ad['description'] = $req->description;
        Advertise::create($ad);

        return back()->with('success', 'New Advertisement Created');
    }
        
    public function updateAdvertise(Request $req, Advertise $advertise)
    {
        $this->validate($req,['link' => 'required','amount' => 'required','adfile' => 'image|mimes:jpeg,png,jpg,gif']);
        $type = Adtype::findOrFail($advertise->adtype_id);

        if($req->hasFile('adfile'))
        {
            if($req->adfile->getClientOriginalExtension() == 'jpeg' || $req->adfile->getClientOriginalExtension() == 'png' || $req->adfile->getClientOriginalExtension() == 'jpg' || $req->adfile->getClientOriginalExtension() == 'gif' )
            {
                $width = Image::make($req->adfile)->width();
                $height = Image::make($req->adfile)->height();
                if($type->width == $width && $type->height == $height)
                {
                    $oldpath = 'assets/images/ads/'.$advertise->photo;
                    if(file_exists($oldpath))
                    {
                        unlink($oldpath);
                    }

                    $filename = uniqid().'.'.$req->adfile->getClientOriginalExtension();
                    $path = 'assets/images/ads/'. $filename;
                    Image::make($req->adfile)->save($path);

                    $advertise['photo'] =  $filename;
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
        $advertise['status'] =  $req->status;
        $advertise['click'] = $req->click;
        $advertise['total'] = $req->amount;
        $advertise['hashid'] = str_random(24);
        $advertise->update();

        return back()->with('success', 'Advertisement Updated');
    }
        
   
    public function userProfileData()
    {
        $user = User::find(Auth::id());
        $pt = 'My Profile';
        return view('user.profile', compact('user','pt'));
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
        $user = User::find(Auth::id());
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
        $user = User::find(Auth::id());
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
     
}
    