<?php

namespace App\Http\Controllers;

use Auth;
use App\Faq;
use App\Blog;
use App\User;
use App\Adtype;
use App\Slider;
use App\Social;
use App\Gateway;
use App\General;
use App\Analytic;
use App\Frontend;
use App\Password;
use App\Advertise;
use App\Publisher;
use App\Subscribe;
use Carbon\Carbon;
use App\Testimonial;
use App\Category;
use App\Comment;
use App\Feature;
use App\Document;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Image;

class VisitorController extends Controller
{
    public function index()
    {
        $gnl = General::first();
        $front = Frontend::first();
        $sliders = Slider::all();
        $testimonials = Testimonial::all();
        $socials = Social::all();
        $posts = Blog::orderBy('id','DESC')->select('id', 'photo', 'heading','slug')->take(3)->get();
        $activities = Activity::orderBy('id','DESC')->select('id', 'image_url', 'heading','slug')->whereNotNull('image_url')->take(3)->get();
        $fts = Feature::all();
        $features = [];
        foreach ($fts as $ft){
            $item['name'] = $ft->name;
            $item['label'] = 'Feature';
            $item['url'] = url('/').'/feature'.'#'.strtolower($ft->name);
            $item['photo'] = url('/').'/images/slider/'.$ft->photo;

            $features[] = $item;
        }

        foreach ($posts as $post) {
            $item['name'] = $post->heading;
            $item['label'] = 'Article';
            $item['url'] = url('/').'/blog/'.$post->slug;
            $item['photo'] = url('/').'/images/blog/'.$post->photo;

            $features[] = $item;
        }
        
        foreach ($activities as $post) {
            $item['name'] = $post->heading;
            $item['label'] = 'Community';
            $item['url'] = url('/').'/feed/'.$post->slug;
            $item['photo'] = url('/').'/images/community/'.$post->image_url;

            $features[] = $item;
        }
        shuffle($features);

        $url = url('/');
        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($gnl->subtitle)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
    
        return view('welcome', compact('gnl','front','sliders','posts','socials','testimonials','features'));
    }
    public function blog()   
    {
        $posts = Blog::orderBy('id','DESC')->paginate(10);
        $categorys = Category::all();
        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');

        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($gnl->subtitle)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);

        return view('blog', compact('posts','categorys'));
    }
    public function blogPost($slug)
    {
        $post = Blog::where('slug', $slug)->first();
        $categorys = Category::all();
        if(is_null($post))
        {
            abort(404);
        }
        $related = Blog::where('category_id', $post->category->id)->with('comments')->take(5)->get();
        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');

        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($post->heading)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1080]);

        Meta::setTitle($gnl->title)
            ->prependTitle($gnl->subtitle)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);

        return view('post', compact('post','categorys', 'related'));
    }

    public function uploadImage(Request $request)
    {
        $response =  array('data' => [], 'error' => "Image upload failed", "status" =>404 );
        return response()->json($response, $response['status']);
        if($request->hasFile('image'))
        {
            $imageName = uniqid().'.'.$request->image->getClientOriginalExtension();
            $path = '/images/blog/'. $imageName;
            chmod(base_path().'/public/images/blog/', 0775);
            Image::make($request->image)->save($path);
            $width = $request->image->getWidth();
            $height = $request->image->getHeight();
            $fotoLink = url('/').$path;

            $data = array( "type"=> "image/".strtolower($request->image->getClientOriginalExtension()),                                    
                            "width"=> $width ,
                            "height"=> $height,                            
                            "name"=> "",                      
                            "link"=> $fotoLink);
            $response =  array('data' => $data, 'success' => true, "status" => 200 );
        }
        return response()->json($response, $response['status']);
    }
    
    public function getAdvertise($pub,$slag)
    {
        header("Access-Control-Allow-Origin: *");
        
        $type = Adtype::where('slag', $slag)->first();
        $gnl = General::first();
        
        if(isset($type))
        {
            
            $ads = Advertise::where('adtype_id', $type->id)->where('status',1)->inRandomOrder()->first();
            
            if(isset($ads))
            {
                $an['user_id'] = $ads->user_id;
                $an['publisher_id'] = $pub;
                $an['type'] = 1;
                Analytic::create($an);
                
                if($ads->click==0)
                {
                    $user = User::find($ads->user_id);
                    if($user->credit > 0)
                    {
                        $user['credit'] = $user->credit - 1;
                        $user->save();
                    }
                    else
                    {
                        $ads['status'] = 0;
                    }
                }
                
                $publisher = Publisher::find($pub);
                
                if(isset($publisher))
                {
                    $publisher['balance'] = $publisher->balance + $gnl->view;
                    $publisher->update();
                }
                                
                $redUrl = route('adClicked',[$pub,$ads->hashid]);
                $photo = asset('assets/images/ads').'/'.$ads->photo;
                $data =  "<a href='".$redUrl."' target='_blank'><img src='".$photo."' width='".$type->width."' height='".$type->height."'/></a><strong style='background-color:#e6e6e6;position:absolute;right:0;top:0;font-size: 10px;color: #666666; padding:4px; margin-right:15px;'>Ads by ".$gnl->title."</strong><span onclick='hideAdverTiseMent(this)' style='position:absolute;right:0;top:0;width:15px;height:20px;background-color:#f00;font-size: 15px;color: #fff;border-radius: 1px;cursor: pointer;'>X</span>";
                
                $ads['count_imp'] = $ads->count_imp + 1;
                $ads->update();
            }
            else
            {
                $logo = asset('assets/ads').'/'.$slag.'.png';
                $data =  "<a href='".url('/')."' target='_blank'><img src='".$logo."'/></a><strong style='background-color:#e6e6e6;position:absolute;right:0;top:0;font-size: 10px;color: #666666; padding:4px; margin-right:15px;'>Ads by ".$gnl->title."</strong><span onclick='hideAdverTiseMent(this)' style='position:absolute;right:0;top:0;width:15px;height:20px;background-color:#f00;font-size: 15px;color: #fff;border-radius: 1px;cursor: pointer;'>X</span>";
            }
        }
        else
        {
            $logo = asset('assets/ads').'/'.$slag.'.png';
            $data =  "<a href='".url('/')."' target='_blank'><img src='".$logo."'/></a><strong style='background-color:#e6e6e6;position:absolute;right:0;top:0;font-size: 10px;color: #666666; padding:4px; margin-right:15px;'>Ads by ".$gnl->title."</strong><span onclick='hideAdverTiseMent(this)' style='position:absolute;right:0;top:0;width:15px;height:20px;background-color:#f00;font-size: 15px;color: #fff;border-radius: 1px;cursor: pointer;'>X</span>";
        }
        
        return $data;
        
    }
    
    public function adClicked($pub,$hash)
    {
        $ad = Advertise::where('hashid', $hash)->first();
        
        if(isset($ad))
        { 
            $an['user_id'] = $ad->user_id;
            $an['publisher_id'] = $pub;
            $an['type'] = 2;
            Analytic::create($an); 
            
            if($ad->click==1)
            {
                $user = User::find($ad->user_id);
                if($user->click > 0)
                {
                    $user['click'] = $user->click - 1;
                    $user->save();
                }
                else
                {
                    $ad['status'] = 0;
                    $ad->update();
                }
                
                $publisher = Publisher::find($pub);
                
                if(isset($publisher))
                {
                    $gnl = General::first();
                    $publisher['balance'] = $publisher->balance + $gnl->click;
                    $publisher->update();
                }
            }
            
            $ad['count_click'] = $ad->count_click + 1;
            $ad->update();
            
            return redirect($ad->link);
        }
        else
        {
            return redirect(url('/'));
        }      
    }
    
    //Advertisement Validation
    public function cronAd()
    {
        $actAds = Advertise::where('status',1)->get();

        foreach($actAds as $item)
        {
            if($item->click==1 && $item->total <= $item->count_click)
            {
                $item['status'] = 0;
                $item->update();
            }
            else if($item->total <= $item->count_imp)
            {
                $item['status'] = 0;
                $item->update();
            }
            else if($item->click==1 && $item->user->click <= 0)
            {
                $item['status'] = 0;
                $item->update();
            }
            else if($item->click==0 && $item->user->credit <= 0)
            {
                $item['status'] = 0;
                $item->update();
            }
        } 
        
        $dactads = Advertise::where('status',0)->get();
        foreach($dactads as $ad)
        {
            if($ad->click==1 && $ad->user->click >= $ad->count_click && $ad->total > $ad->count_click)
            {
                $ad['status'] = 1;
                $ad->update();
            }
            else if($ad->user->credit > 0 && $ad->user->credit >= $ad->count_imp && $ad->total > $ad->count_imp )
            {
                $ad['status'] = 1;
                $ad->update();
            }      
        }
        
    }
    
    //Contact Message
    
    public function contactMessage(Request $request)
    {
        $gnl = General::first();
        
        $to = $gnl->email;
        $from = $request->email;
        $name =  $request->name;
        $subject =  $request->subject;
        $message = $request->message;
        
        if(is_null($from))
        {
            return 11;
        }
        else if(is_null($name))
        {
            return 22;
        }
        else if(is_null($subject))
        {
            return 33;
        }
        else if(is_null($message))
        {
            return 44;
        }
        else
        {
            $headers = "From: $gnl->title <$from> \r\n";
            $headers .= "Reply-To: $gnl->title <$from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            mail($to, $subject, $message, $headers);
            
            return 200;
        }
    }
    
    //Contact Message
    
    public function subscriber(Request $request)
    { 
        $email = $request->email;
        
        if(is_null($email))
        {
            return 22;
        }
        
        $exist = Subscribe::where('email', $email)->first();
        
        if(isset($exist))
        {
            return 11;
        }
        
        $subscribe['email'] = $email;
        Subscribe::create($subscribe);
        
        return 200;
    }
    
    
    //User Authentication
    
    public function verification()
    {
        if(Auth::user()->status == '1' && Auth::user()->emailv == 1 && Auth::user()->smsv == 1)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('auth.verify');
        }
    }
    
    public function sendVcode(Request $request)
    {
        $user = User::find(Auth::id());
        $chktm = $user->vsent+1000;
        if ($chktm > time())
        {
            $delay = $chktm-time();
            return back()->with('alert', 'Please Try after '.$delay.' Seconds');
        }
        else
        {
            $email = $request->email;
            $mobile = $request->mobile;
            $code = uniqid(8);
            $msg = 'Your Verification code is: '.$code;
            $user['vercode'] = $code ;
            $user['vsent'] = time();
            $user->update();
            
            if(isset($email))
            {
                send_email($user->email, $user->username, 'Verification Code', $msg);
                return back()->with('success', 'Email verification code sent succesfully');
            }
            elseif(isset($mobile))
            {
                send_sms($user->mobile, $msg);
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
        $this->validate($request, ['code' => 'required']);
        $user = User::find(Auth::id());
        $code = $request->code;
        
        if ($user->vercode == $code)
        {
            $user['emailv'] = 1;
            $user['vercode'] = uniqid(10);
            $user['vsent'] = 0;
            $user->save();
            
            return redirect()->route('home')->with('success', 'Email Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }
        
    }
    
    public function smsVerify(Request $request)
    {
        $this->validate($request, ['code' => 'required']);
        $user = User::find(Auth::id());
        $code = $request->code;
        
        if ($user->vercode == $code)
        {
            $user['smsv'] = 1;
            $user['vercode'] = uniqid(10);
            $user['vsent'] = 0;
            $user->save();
            
            return redirect()->route('home')->with('success', 'Mobile Number Verified');
        }
        else
        {
            return back()->with('alert', 'Wrong Verification Code');
        }
        
    }
    
    public function resetEmail()
    {
        return view('auth.passwords.email');
    }
    
    public function sendEmail(Request $request)
    {
        $this->validate($request, ['email'   => 'required']);
        
        $efind = User::where('email', $request->email)->first();
        
        if(isset($efind))
        {
            $code = uniqid(32);
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
            $user = User::where('email', $tval->email)->first();
            $username = $user->username;
            return view('auth.passwords.reset', compact('username','token'));
        }
        else
        {
            return redirect()->route('login')->withAlert('Invalid Token');;
        }
        
    }
    
    public function resetPassword(Request $request)
    {
        $this->validate($request,
        ['token' => 'required','password' => 'required',
        'password_confirmation' => 'required',
        ]);
        $now = Carbon::now();
        $reset = Password::where('token', $request->token)->where('status',0)->where('created_at', '>', $now->subMinutes(30))->first();
        if(isset($reset)) 
        {
            $user = User::where('email', $reset->email)->first();
            
            if($request->password == $request->password_confirmation)
            {
                $user['password'] = Hash::make($request->password);
                $user->update();
                
                $reset['status'] = 1;
                $reset->update();
                
                $msg =  'Password Changed Successfully';
                send_email($user->email, $user->username, 'Password Changed', $msg);
                $sms =  'Password Changed Successfully';
                send_sms($user->mobile, $sms);
                
                return redirect()->route('login')->with('success', 'Password Changed');
            }
            else 
            {
                return back()->with('alert', 'Password Not Matched');
            }
            
        }
        else
        {
            return redirect()->route('login')->with('alert', 'Invalid Reset Link');
        }
    }


    public function blogComment(Request $req)
    {
        $this->validate($req, ['comment' => 'required','blog' => 'required']);
        $arr['blog_id'] = $req->blog;
        $arr['text'] = $req->comment;
        $arr['member_id'] = $req->user()->id;

        Comment::create($arr);
        return back()->with('success','Your have added a comment');
    }

    public function subComment(Request $req)
    {
        $this->validate($req, ['comment' => 'required', 'comment_id' => 'required']);
        $post['parent_id'] = $req->comment_id;
        $post['text'] = $req->comment;
        $post['member_id'] = $req->user()->id;

        Comment::create($post);
        return back()->with('success','Your have added a comment');
    }


    public function likeBlog(Request $request)
    {
        $this->validate($request, ['blog' => 'required']);
        $post = Blog::find($request->blog);
        if($post) {
            if ($post->likedBy($request->user())) {
                return response(null, 409);
            }

            $post->likes()->create([
                'member_id' => $request->user()->id,
                'blog_id' => $post->id,
            ]);

            if (!$post->likes()->onlyTrashed()->where('member_id', $request->user()->id)->count()) {
                // Mail::to($post->member)->send(new PostLiked(auth()->user(), $post));
            }
        }
        return back();
    }

    public function dislikeBlog(Request $request)
    {
        $this->validate($request, ['blog' => 'required']);
        $request->user()->likes()->where('blog_id', $request->blog)->delete();

        return back();
    }

    public function commentLikes(Request $request)
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
                // Mail::to($post->member)->send(new PostLiked(auth()->user(), $comment));
            }
        }
        return back();
    }

    public function commentDislikes(Request $request)
    {
        $this->validate($request, ['comment' => 'required']);
        $request->user()->likes()->where('comment_id', $request->comment)->delete();

        return back();
    }

    public function contactForm()
    {
        $front = Frontend::first();
        $faqs = Faq::all();
        $gnl = General::first();
        $url = url('/');
        
        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($front->banner_heading)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
        return view('contact', compact('front','faqs'));
    }

    public function privacyPolicy()
    {
        $doc = Document::first();
        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');
        
        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($front->banner_heading)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
        return view('privacypolicy', compact('doc'));
    }

    public function termSale()
    {
        $doc = Document::first();
        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');
        
        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($front->banner_heading)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
        return view('termsale', compact('doc'));
    }

    public function refundPolicy()
    {
        $doc = Document::first();
        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');
        
        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($front->banner_heading)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
        return view('refundpolicy',compact('doc'));
    }

    public function cookiePolicy()
    {
        $doc = Document::first();
        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');
        
        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($front->banner_heading)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
        return view('cookiepolicy',compact('doc'));
    }

    public function featured()
    {
        $advertisers = Feature::where('name', 'Advertiser')->get();
        $publishers = Feature::where('name', 'Publisher')->get();
        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');
        
        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url.'/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($gnl->title)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($front->banner_heading)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency','Kenya','Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical($url)
            ->setCharset()
            ->setFavicon($url .'/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);        

        return view('features', compact('advertisers','publishers'));
    }
}
