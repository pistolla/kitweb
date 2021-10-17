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
use App\Frontend;
use App\PostView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

class CommunityController extends Controller
{
    public function dashboard(Request $req, $tag = 'trending')
    {
        $activities = [];
        if ($tag == 'trending') {
            $activities = Activity::latest()->with(['member', 'comments', 'likes'])->paginate(50);
        } else if ($tag == 'recent') {
            $activities = Activity::latest()->with(['member', 'comments', 'likes'])->paginate(50);
        } else if ($tag == 'related') {
            $activities = Activity::latest()->with(['member', 'comments', 'likes'])->paginate(50);
        } else {
            $member = Member::where('username', ' = ', $tag)->first();
            $activities = Activity::latest()->with(['member', 'comments', 'likes'])->paginate(50);
        }

        $suggested = [];
        $post = null;
        $activities->shuffle();
        if ($activities) {
            $post = $activities->shift();
            PostView::recordView($post);
        }
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
            ->addImage($url . '/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($front->banner_heading)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($gnl->subtitle)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency', 'Kenya', 'Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical(url(''))
            ->setCharset()
            ->setFavicon(url('') . '/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
        return view('feed.dashboard', compact('activities', 'post', 'suggested', 'tag'));
    }

    public function enquireLatest(Request $req)
    {
        $lastId = $req->input('last_id');
        $search = $req->input('search');

        $activity = Activity::query()
            ->where('id', ' > ', $lastId)
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->first();

        if ($activity && !empty($activity)) {
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

    function removeCommonWords($input)
    {

        // EEEEEEK Stop words
        $commonWords = array('a', 'able', 'about', 'above', 'abroad', 'according', 'accordingly', 'across', 'actually', 'adj', 'after', 'afterwards', 'again', 'against', 'ago', 'ahead', 'ain\'t', 'all', 'allow', 'allows', 'almost', 'alone', 'along', 'alongside', 'already', 'also', 'although', 'always', 'am', 'amid', 'amidst', 'among', 'amongst', 'an', 'and', 'another', 'any', 'anybody', 'anyhow', 'anyone', 'anything', 'anyway', 'anyways', 'anywhere', 'apart', 'appear', 'appreciate', 'appropriate', 'are', 'aren\'t', 'around', 'as', 'a\'s', 'aside', 'ask', 'asking', 'associated', 'at', 'available', 'away', 'awfully', 'b', 'back', 'backward', 'backwards', 'be', 'became', 'because', 'become', 'becomes', 'becoming', 'been', 'before', 'beforehand', 'begin', 'behind', 'being', 'believe', 'below', 'beside', 'besides', 'best', 'better', 'between', 'beyond', 'both', 'brief', 'but', 'by', 'c', 'came', 'can', 'cannot', 'cant', 'can\'t', 'caption', 'cause', 'causes', 'certain', 'certainly', 'changes', 'clearly', 'c\'mon', 'co', 'co.', 'com', 'come', 'comes', 'concerning', 'consequently', 'consider', 'considering', 'contain', 'containing', 'contains', 'corresponding', 'could', 'couldn\'t', 'course', 'c\'s', 'currently', 'd', 'dare', 'daren\'t', 'definitely', 'described', 'despite', 'did', 'didn\'t', 'different', 'directly', 'do', 'does', 'doesn\'t', 'doing', 'done', 'don\'t', 'down', 'downwards', 'during', 'e', 'each', 'edu', 'eg', 'eight', 'eighty', 'either', 'else', 'elsewhere', 'end', 'ending', 'enough', 'entirely', 'especially', 'et', 'etc', 'even', 'ever', 'evermore', 'every', 'everybody', 'everyone', 'everything', 'everywhere', 'ex', 'exactly', 'example', 'except', 'f', 'fairly', 'far', 'farther', 'few', 'fewer', 'fifth', 'first', 'five', 'followed', 'following', 'follows', 'for', 'forever', 'former', 'formerly', 'forth', 'forward', 'found', 'four', 'from', 'further', 'furthermore', 'g', 'get', 'gets', 'getting', 'given', 'gives', 'go', 'goes', 'going', 'gone', 'got', 'gotten', 'greetings', 'h', 'had', 'hadn\'t', 'half', 'happens', 'hardly', 'has', 'hasn\'t', 'have', 'haven\'t', 'having', 'he', 'he\'d', 'he\'ll', 'hello', 'help', 'hence', 'her', 'here', 'hereafter', 'hereby', 'herein', 'here\'s', 'hereupon', 'hers', 'herself', 'he\'s', 'hi', 'him', 'himself', 'his', 'hither', 'hopefully', 'how', 'howbeit', 'however', 'hundred', 'i', 'i\'d', 'ie', 'if', 'ignored', 'i\'ll', 'i\'m', 'immediate', 'in', 'inasmuch', 'inc', 'inc.', 'indeed', 'indicate', 'indicated', 'indicates', 'inner', 'inside', 'insofar', 'instead', 'into', 'inward', 'is', 'isn\'t', 'it', 'it\'d', 'it\'ll', 'its', 'it\'s', 'itself', 'i\'ve', 'j', 'just', 'k', 'keep', 'keeps', 'kept', 'know', 'known', 'knows', 'l', 'last', 'lately', 'later', 'latter', 'latterly', 'least', 'less', 'lest', 'let', 'let\'s', 'like', 'liked', 'likely', 'likewise', 'little', 'look', 'looking', 'looks', 'low', 'lower', 'ltd', 'm', 'made', 'mainly', 'make', 'makes', 'many', 'may', 'maybe', 'mayn\'t', 'me', 'mean', 'meantime', 'meanwhile', 'merely', 'might', 'mightn\'t', 'mine', 'minus', 'miss', 'more', 'moreover', 'most', 'mostly', 'mr', 'mrs', 'much', 'must', 'mustn\'t', 'my', 'myself', 'n', 'name', 'namely', 'nd', 'near', 'nearly', 'necessary', 'need', 'needn\'t', 'needs', 'neither', 'never', 'neverf', 'neverless', 'nevertheless', 'new', 'next', 'nine', 'ninety', 'no', 'nobody', 'non', 'none', 'nonetheless', 'noone', 'no-one', 'nor', 'normally', 'not', 'nothing', 'notwithstanding', 'novel', 'now', 'nowhere', 'o', 'obviously', 'of', 'off', 'often', 'oh', 'ok', 'okay', 'old', 'on', 'once', 'one', 'ones', 'one\'s', 'only', 'onto', 'opposite', 'or', 'other', 'others', 'otherwise', 'ought', 'oughtn\'t', 'our', 'ours', 'ourselves', 'out', 'outside', 'over', 'overall', 'own', 'p', 'particular', 'particularly', 'past', 'per', 'perhaps', 'placed', 'please', 'plus', 'possible', 'presumably', 'probably', 'provided', 'provides', 'q', 'que', 'quite', 'qv', 'r', 'rather', 'rd', 're', 'really', 'reasonably', 'recent', 'recently', 'regarding', 'regardless', 'regards', 'relatively', 'respectively', 'right', 'round', 's', 'said', 'same', 'saw', 'say', 'saying', 'says', 'second', 'secondly', 'see', 'seeing', 'seem', 'seemed', 'seeming', 'seems', 'seen', 'self', 'selves', 'sensible', 'sent', 'serious', 'seriously', 'seven', 'several', 'shall', 'shan\'t', 'she', 'she\'d', 'she\'ll', 'she\'s', 'should', 'shouldn\'t', 'since', 'six', 'so', 'some', 'somebody', 'someday', 'somehow', 'someone', 'something', 'sometime', 'sometimes', 'somewhat', 'somewhere', 'soon', 'sorry', 'specified', 'specify', 'specifying', 'still', 'sub', 'such', 'sup', 'sure', 't', 'take', 'taken', 'taking', 'tell', 'tends', 'th', 'than', 'thank', 'thanks', 'thanx', 'that', 'that\'ll', 'thats', 'that\'s', 'that\'ve', 'the', 'their', 'theirs', 'them', 'themselves', 'then', 'thence', 'there', 'thereafter', 'thereby', 'there\'d', 'therefore', 'therein', 'there\'ll', 'there\'re', 'theres', 'there\'s', 'thereupon', 'there\'ve', 'these', 'they', 'they\'d', 'they\'ll', 'they\'re', 'they\'ve', 'thing', 'things', 'think', 'third', 'thirty', 'this', 'thorough', 'thoroughly', 'those', 'though', 'three', 'through', 'throughout', 'thru', 'thus', 'till', 'to', 'together', 'too', 'took', 'toward', 'towards', 'tried', 'tries', 'truly', 'try', 'trying', 't\'s', 'twice', 'two', 'u', 'un', 'under', 'underneath', 'undoing', 'unfortunately', 'unless', 'unlike', 'unlikely', 'until', 'unto', 'up', 'upon', 'upwards', 'us', 'use', 'used', 'useful', 'uses', 'using', 'usually', 'v', 'value', 'various', 'versus', 'very', 'via', 'viz', 'vs', 'w', 'want', 'wants', 'was', 'wasn\'t', 'way', 'we', 'we\'d', 'welcome', 'well', 'we\'ll', 'went', 'were', 'we\'re', 'weren\'t', 'we\'ve', 'what', 'whatever', 'what\'ll', 'what\'s', 'what\'ve', 'when', 'whence', 'whenever', 'where', 'whereafter', 'whereas', 'whereby', 'wherein', 'where\'s', 'whereupon', 'wherever', 'whether', 'which', 'whichever', 'while', 'whilst', 'whither', 'who', 'who\'d', 'whoever', 'whole', 'who\'ll', 'whom', 'whomever', 'who\'s', 'whose', 'why', 'will', 'willing', 'wish', 'with', 'within', 'without', 'wonder', 'won\'t', 'would', 'wouldn\'t', 'x', 'y', 'yes', 'yet', 'you', 'you\'d', 'you\'ll', 'your', 'you\'re', 'yours', 'yourself', 'yourselves', 'you\'ve', 'z', 'zero');

        return preg_replace('/\b(' . implode('|', $commonWords) . ')\b/', '', $input);
    }

    public function fetchActivity($slug)
    {
        $post = Activity::where('slug', $slug)->with(['member', 'comments', 'likes', 'dislikes'])->first();
        if (is_null($post)) {
            abort('404');
        }
        PostView::recordView($post);
        $uniqueWords = $this->removeCommonWords($post->heading);

        $headingArr = preg_match_all('/[a-z]+/', $uniqueWords, $output) ? $output[0] : [];

        $suggested = collect([]);
        foreach ($headingArr as $key => $value) {
            $suggested->merge(Activity::query()->where('details', 'LIKE', "%$value%")->get());
        }
        $suggested->unique('id');

        $front = Frontend::first();
        $gnl = General::first();
        $url = url('/');
        $total_posts = Activity::where("member_id", $post->member->id)->count();
        $total_comments = Comment::where("member_id", $post->member->id)->count();;
        $activity_level = (int)(($total_posts / ($total_posts + $total_comments + 1)) * 100);

        $og = new OpenGraphPackage('kenyansintexas_fb');
        $og->setType('website')
            ->setSiteName($gnl->title)
            ->setDescription($front->about_details)
            ->setTitle($gnl->title)
            ->setUrl($url)
            ->setLocale('en_US')
            ->addImage($url . '/img/bg/header-bg.png')
            ->addVideo($front->video);


        $card = new TwitterCardPackage('kenyansintexas_twitter');

        $card->setType($gnl->title)
            ->setSite('@twitterdev')
            ->setCreator('@dataphile_joe')
            ->setTitle($front->banner_heading)
            ->setDescription($front->about_details)
            ->setVideo($front->video, ['width' => 1920, 'height' => 1280]);

        Meta::setTitle($gnl->title)
            ->prependTitle($gnl->subtitle)
            ->setTitleSeparator('|')
            ->setDescription($front->about_details)
            ->setKeywords(['Advertising agency', 'Kenya', 'Texas'])
            ->setRobots('nofollow,noindex')
            ->setCanonical(url(''))
            ->setCharset()
            ->setFavicon(url('') . '/images/icon.png')
            ->registerPackage($og)
            ->registerPackage($card);
        return view('feed.activity', compact('post', 'suggested', 'total_comments', 'total_posts', 'activity_level'));
    }

    public function searchPost(Request $req)
    {
        $search = $req->input('search');
        $activities = Activity::query()
            ->where('heading', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->with(['member', 'comments', 'likes'])->paginate(20);
        $post = null;
        if (is_array($activities)) {
            $post = $activities->shift();
        }
        return view('feed.dashboard', compact('activities', 'post'));
    }

    public function createActivity(Request $request)
    {
        $this->validate(
            $request,
            [
                'heading' => 'required',
                'details' => 'required',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );
        $post['heading'] = $request->heading;
        $post['details'] = $request->details;
        $post['member_id'] = $request->user()->id;
        $post['slug'] = str_replace(" ", "_", strtolower($request->heading));
        if ($request->hasFile('photos') && !empty($request->file('photos'))) {
            $images = [];
            if (is_array($request->file('photos'))) {
                foreach ($request->file('photos') as $image) {
                    $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path() . '/images/community', $fileName);

                    $images[] = $fileName;
                }
            } else {
                $image = $request->file('photos');
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/images/community', $fileName);

                $images[] = $fileName;
            }
            $post['image_url'] = implode(";", $images);
        }
        if ($request->has('link_url') && !empty($request->link_url)) {
            $post['link_url'] = $request->link_url;
        }
        if ($request->has('link_phone') && !empty($request->link_phone)) {
            $post['link_phone'] = $request->link_phone;
        }
        Activity::create($post);
        return back()->with('success', 'Your post is now available');
    }

    public function createComment(Request $req)
    {
        $this->validate($req, ['activity' => 'required', 'comment' => 'required']);
        $post['activity_id'] = $req->activity;
        $post['text'] = $req->comment;
        $post['member_id'] = $req->user()->id;

        Comment::create($post);
        return back()->with('success', 'Your have added a comment');
    }

    public function subscribe(Request $req)
    {
    }

    public function unsubscribe(Request $reqs)
    {
    }

    public function likeActivity(Request $request)
    {
        $this->validate($request, ['activity' => 'required']);
        $post = Activity::find($request->activity);
        if ($post) {
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
        if ($comment) {
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
        $this->validate(
            $request,
            [
                'password' => 'required|string|min:6|confirmed'
            ]
        );
        $user = Member::find(Auth::guard('feed')->user()->id);
        if ($request->password == $request->password_confirmation) {
            $user['password'] = Hash::make($request->password);
            $user->update();

            return back()->with('success', 'Password Changed');
        } else {
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
        if (Auth::guard('feed')->user()->status == '1' && Auth::guard('feed')->user()->emailv == 1 && Auth::guard('feed')->user()->smsv == 1) {
            return redirect()->route('feed.dashboard');
        } else {
            return view('feed.auth.verify');
        }
    }

    public function showRegistrationForm()
    {
        $gnl = General::first();
        if (1 == $gnl->reg) {
            $countries = Country::all();
            return view('feed.auth.register', compact('countries'));
        } else {
            return redirect()->route('feed.dashboard')->with('alert', 'Registration Closed Now');
        }
    }

    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:members',
                'username' => 'required|alpha_num|max:25|unique:members|alpha_dash',
                'password' => 'required|string|min:6|confirmed',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'mobile' => 'required|string',
            ]
        );
        $gnl = General::first();

        if (1 == $gnl->reg) {
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

            if (Auth::guard('feed')->attempt([
                'username' => $request->username,
                'password' => $request->password
            ])) {
                return redirect()->route('feed.dashboard');
            } else {
                return redirect()->route('feed.register')->with('alert', 'Failed to Register');
            }
        }
    }

    private function _joinPhoneCode($code, $phone)
    {
        $tempPhone = $phone;
        if (!empty($code) && !empty($phone)) {
            if (substr($phone, 0, 1) == '0') {
                $tempPhone = $code . substr($phone, 1, strlen($phone));
            } else if (substr($phone, 0, strlen($code)) == $code) {
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


        if (Auth::guard('feed')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('feed.dashboard');
        } else {
            return redirect()->route('feed.login')->with('alert', 'Username and Password Not Matched');
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
        $chktm = $member->vsent + 1000;
        if ($chktm > time()) {
            $delay = $chktm - time();
            return back()->with('alert', 'Please Try after ' . $delay . ' Seconds');
        } else {
            $email = $request->email;
            $mobile = $request->mobile;
            $code = uniqid(8);
            $msg = 'Your Verification code is: ' . $code;
            $member['vercode'] = $code;
            $member['vsent'] = time();
            $member->update();

            if (isset($email)) {
                send_email($member->email, $member->username, 'Verification Code', $msg);
                return back()->with('success', 'Email verification code sent succesfully');
            } elseif (isset($mobile)) {
                send_sms($member->mobile, $msg);
                return back()->with('success', 'SMS verification code sent succesfully');
            } else {
                return back()->with('alert', 'Sending Failed');
            }
        }
    }

    public function emailVerify(Request $request)
    {
        $this->validate($request, ['code' => 'required']);
        $member = Member::find(Auth::guard('feed')->user()->id);
        $code = $request->code;

        if ($member->vercode == $code) {
            $member['emailv'] = 1;
            $member['vercode'] = uniqid(10);
            $member['vsent'] = 0;
            $member->save();

            return redirect()->route('feed.dashboard')->with('success', 'Email Verified');
        } else {
            return back()->with('alert', 'Wrong Verification Code');
        }
    }

    public function smsVerify(Request $request)
    {
        $this->validate($request, ['code' => 'required']);
        $member = Member::find(Auth::guard('feed')->user()->id);
        $code = $request->code;

        if ($member->vercode == $code) {
            $member['smsv'] = 1;
            $member['vercode'] = uniqid(10);
            $member['vsent'] = 0;
            $member->save();

            return redirect()->route('feed.dashboard')->with('success', 'Mobile Number Verified');
        } else {
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

        if (isset($efind)) {
            $code = uniqid(32);
            $pass['email'] = $request->email;
            $pass['token'] = $code;
            $pass['status'] = 0;
            Password::create($pass);

            $to = $request->email;
            $name = 'User';
            $subject = 'Reset Password';
            $message = 'Use This Link to Reset Password: ' . url('/') . '/' . 'password-reset' . '/' . $code;

            send_email($to, $name, $subject, $message);

            return back()->withSuccess('Mail Sent Successfuly');
        } else {
            return back()->withAlert('Invalid Email Address');
        }
    }

    public function resetForm($token)
    {
        $now = Carbon::now();
        $tval = Password::where('token', $token)->where('status', 0)->where('created_at', '>', $now->subMinutes(30))->first();

        if (isset($tval)) {
            $member = Member::where('email', $tval->email)->first();
            $username = $member->username;
            return view('feed.auth.passwords.reset', compact('username', 'token'));
        } else {
            return redirect()->route('feed.login')->withAlert('Invalid Token');;
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, ['token' => 'required', 'password' => 'required', 'password_confirmation' => 'required']);
        $now = Carbon::now();
        $reset = Password::where('token', $request->token)->where('status', 0)->where('created_at', '>', $now->subMinutes(30))->first();
        if (isset($reset)) {
            $member = Member::where('email', $reset->email)->first();

            if ($request->password == $request->password_confirmation) {
                $member['password'] = Hash::make($request->password);
                $member->update();

                $reset['status'] = 1;
                $reset->update();

                $msg =  'Password Changed Successfully';
                send_email($member->email, $member->username, 'Password Changed', $msg);
                $sms =  'Password Changed Successfully';
                send_sms($member->mobile, $sms);

                return redirect()->route('feed.login')->with('success', 'Password Changed');
            } else {
                return back()->with('alert', 'Password Not Matched');
            }
        } else {
            return redirect()->route('feed.login')->with('alert', 'Invalid Reset Link');
        }
    }

    public function cityForCountryAjax($country_id)
    {
        $id = urldecode($country_id);
        $states = Country::join("states", "states.country_id", "=", "countries.id")
            ->where("countries.id", $id)
            ->get(['states.name', 'states.id', 'countries.phonecode']);
        return json_encode($states);
    }

    public function getProfileData(Request $request, $name)
    {
        $user = Member::where("username", '=', $name)->first();
        $count = Activity::where("member_id", $user->id)->count();
        $posts = Activity::where('member_id', '=', $user->id)->orderBy('id', 'DESC')->paginate(10);
        $pt = 'My Profile';
        return view('feed.profile', compact('user', 'pt', 'posts', 'count'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'country' => 'required',
                'city' => 'required'
            ]
        );
        $user = Member::find(Auth::id());
        if ($request->hasFile('photo')) {
            $oldpath = '/images/community/' . $user->photo;
            if (file_exists($oldpath)) {
                unlink($oldpath);
            }

            $user['photo'] = uniqid() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path() . '/images/community/', $user['photo']);
        }

        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['mobile'] = $request->mobile;
        $user['country'] = $request->country;
        $user['city'] = $request->city;
        $user['website'] = $request->website;
        $user['facebook'] = $request->facebook;
        $user['whatsapp'] = $request->whatsapp;
        $user['bio'] = $request->bio;
        $user->update();
        return back()->with('success', 'Profile Data Updated');
    }

    public function deletePost(Request $request)
    {
        $id = $request->id;
        $post = Activity::findOrFail($id);
        if ($post->photo) {
            $path = public_path() . '/images/community/' . $post->photo;

            if (file_exists($path)) {
                unlink($path);
            }
        }
        $post->delete();

        return back()->with('success', 'Post Deleted Successfully!');
    }
}
