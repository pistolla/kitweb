<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Payment IPN
Route::get('/ipnbtc', 'PaymentController@ipnBchain')->name('ipn.bchain');
Route::get('/ipnblockbtc', 'PaymentController@blockIpnBtc')->name('ipn.block.btc');
Route::get('/ipnblocklite', 'PaymentController@blockIpnLite')->name('ipn.block.lite');
Route::get('/ipnblockdog', 'PaymentController@blockIpnDog')->name('ipn.block.dog');
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::post('/ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::post('/ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('/ipncoinpaybch', 'PaymentController@ipnCoinPayBch')->name('ipn.coinPay.bch');
Route::post('/ipncoinpaydash', 'PaymentController@ipnCoinPayDash')->name('ipn.coinPay.dash');
Route::post('/ipncoinpaydoge', 'PaymentController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
Route::post('/ipncoinpayltc', 'PaymentController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
Route::post('/ipncoin', 'PaymentController@ipnCoin')->name('ipn.coinpay');
Route::post('/ipncoingate', 'PaymentController@ipnCoinGate')->name('ipn.coingate');
//Payment IPN

//Cron To Validate Ad
Route::get('/cron-ad', 'VisitorController@cronAd'); 

// Social Auth
Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

//Advertise API
Route::get('/ads/{publisher}/{type}', 'VisitorController@getAdvertise')->name('adsUrl'); 
Route::get('/ad-clicked/{publisher}/{hash}', 'VisitorController@adClicked')->name('adClicked'); 
Route::get('/', 'VisitorController@index')->name('user.index'); 
Route::get('/blog', 'VisitorController@blog')->name('user.blog'); 
Route::get('/blog/{slug}', 'VisitorController@blogPost')->name('user.blog-post'); 
Route::get('/about', 'VisitorController@contactForm')->name('contact');
Route::post('/contact-message', 'VisitorController@contactMessage')->name('contact.message');   
Route::post('/subscriber', 'VisitorController@subscriber')->name('subscriber');
Route::post('/upload', 'VisitorController@uploadImage')->name('blog.upload');

Route::group(['middleware' => ['auth.member:feed']], function() {
    Route::group(['prefix' => 'blog'], function () 
    {
        Route::post('/blog-comment', 'VisitorController@blogComment')->name('blog.blogcomment');   
        Route::post('/sub-comment', 'VisitorController@subComment')->name('blog.comment');   
        Route::post('/blog-comment-like', 'VisitorController@commentLikes')->name('blog.commentlikes');   
        Route::post('/blog-comment-dislike', 'VisitorController@commentDislikes')->name('blog.commentdislikes');
        Route::post('/blog-like', 'VisitorController@likeBlog')->name('blog.likes');   
        Route::post('/blog-dislike', 'VisitorController@dislikeBlog')->name('blog.dislikes');
    });
});   

Route::get('/privacy-policy', 'VisitorController@privacyPolicy')->name('user.privacy'); 
Route::get('/term-of-service', 'VisitorController@termSale')->name('user.terms'); 
Route::get('/refund-policy', 'VisitorController@refundPolicy')->name('user.refund');
Route::get('/cookie-policy', 'VisitorController@cookiePolicy')->name('user.cookie'); 
Route::get('/feature', 'VisitorController@featured')->name('user.features'); 

Route::get('/404', function () {
    return view('404');
})->name('404');
Auth::routes();

//Advertiser verification
Route::get('/verifiaction', 'VisitorController@verification')->name('user.verify');        
Route::post('/send-vcode', 'VisitorController@sendVcode')->name('user.send-vcode');        
Route::post('/email-verify', 'VisitorController@emailVerify')->name('user.email-verify');        
Route::post('/sms-verify', 'VisitorController@smsVerify')->name('user.sms-verify');        
    
//Password Reset
Route::get('/password-resetreq', 'VisitorController@resetEmail')->name('password.resetreq');        
Route::post('/password-sendemail', 'VisitorController@sendEmail')->name('password.sendemail');        
Route::get('/password-reset/{token}', 'VisitorController@resetForm')->name('password.resetform');        
Route::post('/reset-password', 'VisitorController@resetPassword')->name('password.resetpassword');
        

//User Routes
Route::group(['middleware' => ['auth','uverify']], function() {
    Route::group(['prefix' => 'home'], function () 
    {
        Route::get('/', 'HomeController@index')->name('home');        
        Route::get('/profile-info', 'HomeController@userProfileData')->name('user.profile-data');               
        Route::post('/update-profile', 'HomeController@updateProfile')->name('user.update-profile');        
        Route::post('/change-password', 'HomeController@changePassword')->name('user.change-passwordpost');               
        Route::get('/transactions', 'HomeController@transactionLog')->name('user.transactions'); 
        
        Route::get('/deposit-pay', 'HomeController@deposit')->name('user.balance');
        Route::post('/deposit-pay', 'HomeController@deposit')->name('user.balance');
		Route::get('/deposit', 'HomeController@deposit')->name('user.deposit');		               
        Route::post('/deposit-data-insert', 'HomeController@depositDataInsert')->name('deposit.data-insert');
        Route::get('/deposit-preview', 'HomeController@depositPreview')->name('deposit.preview');
        Route::post('/deposit-confirm', 'PaymentController@depositConfirm')->name('deposit.confirm');
        Route::post('/deposit-mpesa', 'PaymentController@depositMpesa')->name('deposit.mpesa');
        Route::delete('/cancel-deposit/{id}', 'PaymentController@cancelDeposit')->name('cancel.deposit');  

        Route::get('/plans', 'HomeController@plans')->name('user.plans');
        Route::post('/get-plan', 'HomeController@getPlan')->name('user.get-plan');
     
        Route::get('/ads', 'HomeController@advertise')->name('user.ads');
        Route::post('/ads-create', 'HomeController@createAdvertise')->name('user.create-ad');
        Route::put('/ads-update/{advertise}', 'HomeController@updateAdvertise')->name('user.update-ad');
        
       
    });
});

//Publisher Auth
Route::prefix('publisher')->group(function() {
    Route::get('/', 'PublisherController@showLoginForm')->name('publisher.login')->middleware('guest:publisher');
    Route::post('/login', 'PublisherController@login')->name('publisher.loginpost')->middleware('guest:publisher');
    Route::get('/register', 'PublisherController@showRegistrationForm')->name('publisher.register')->middleware('guest:publisher');
    Route::post('/register-post', 'PublisherController@register')->name('publisher.registerpost')->middleware('guest:publisher');
    Route::post('/logout', 'PublisherController@logout')->name('publisher.logout');
   
    //Publisher verification
    Route::get('/verification', 'PublisherController@publisherVerifaction')->name('publisher.verify');       
    Route::post('/send-vcode', 'PublisherController@sendVcode')->name('publisher.send-vcode');        
    Route::post('/email-verify', 'PublisherController@emailVerify')->name('publisher.email-verify');        
    Route::post('/sms-verify', 'PublisherController@smsVerify')->name('publisher.sms-verify'); 

    //Password Reset
    Route::get('/password-reset', 'PublisherController@resetEmail')->name('pub.password.resetreq');        
    Route::post('/password-sendemail', 'PublisherController@sendEmail')->name('pub.password.sendemail');        
    Route::get('/password-reset/{token}', 'PublisherController@resetForm')->name('pub.password.resetform');        
    Route::post('/reset-password', 'PublisherController@resetPassword')->name('pub.password.resetpassword');
    
  });

//Publisher Routes
Route::group(['middleware' => ['auth:publisher','pverify']], function() {
    Route::group(['prefix' => 'publisher'], function () 
    {
        Route::get('/dashboard', 'PublisherController@dashboard')->name('publisher.dashboard');        
        Route::get('/get-ads', 'PublisherController@getAds')->name('publisher.getads');        
        Route::get('/profile-info', 'PublisherController@userProfileData')->name('publisher.profile-data');               
        Route::post('/update-profile', 'PublisherController@updateProfile')->name('publisher.update-profile');        
        Route::post('/change-password', 'PublisherController@changePassword')->name('publisher.change-passwordpost');  
        
        Route::get('/withdraw', 'PublisherController@withdraw')->name('publisher.withdraw');           
        Route::post('/withdraw-post', 'PublisherController@withdrawPost')->name('withdraw.post');    
        
                 
    });
});


//Admin Routes
Route::group(['middleware' => ['auth:admin']], function() {
Route::prefix('admin')->group(function() {
    
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    
    //General Settings
    Route::get('/general', 'AdminController@general')->name('admin.general');
    Route::post('/general-update', 'AdminController@generalUpdate')->name('admin.gnlupdate');
    
    //Payment Gateway
    Route::get('/gateway', 'AdminController@gateway')->name('admin.gateway');
    Route::post('/gateway-craete', 'AdminController@gatewayCreate')->name('admin.gatecre');
    Route::put('/gateway-update/{gateway}', 'AdminController@gatewayUpdate')->name('admin.gateup');
    
     //Withdraw Gateway
     Route::get('/wmethod', 'AdminController@wmethod')->name('admin.wmethod');
     Route::post('/wmethod-craete', 'AdminController@wmethodCreate')->name('admin.wmethod-create');
     Route::put('/wmethod-update/{wmethod}', 'AdminController@wmethodUpdate')->name('admin.wmethod-update');
    
    //Logo-Icon
    Route::get('/logo-icon', 'AdminController@logoIcon')->name('admin.logo');
    Route::post('/logo-update', 'AdminController@logoUpdate')->name('admin.logoupdate');
    //Email-SMS
    Route::get('/email-sms', 'AdminController@emailSms')->name('admin.email');
    Route::post('/email-update', 'AdminController@emailUpdate')->name('admin.emailup');

    //User Management
    Route::get('/users', 'AdminController@userIndex')->name('admin.users');
    Route::post('/user-search', 'AdminController@userSearch')->name('admin.search-users');
    Route::get('/user/{user}', 'AdminController@singleUser')->name('admin.user-single');
    Route::get('/user-banned', 'AdminController@bannedUser')->name('admin.user-ban');
    Route::get('/mail/{user}', 'AdminController@email')->name('admin.user-email');
    Route::post('/sendmail', 'AdminController@sendemail')->name('admin.send-email');
    Route::put('/user/pass-change/{user}', 'AdminController@userPasschange')->name('admin.user-pass');
    Route::put('/user/status/{user}', 'AdminController@statupdate')->name('admin.user-status');
    
    Route::get('/subscribers', 'AdminController@subscribers')->name('admin.subscribers');
    Route::post('/subscribers-email', 'AdminController@subsEmail')->name('admin.subscribers-email');
    Route::delete('/subscriber/{id}', 'AdminController@subscriberDelete')->name('admin.subscriber-delete');
    
    //Publisher Management
    Route::get('/publishers', 'AdminController@publisherIndex')->name('admin.publishers');
    Route::post('/publisher-search', 'AdminController@publisherSearch')->name('admin.search-publishers');
    Route::get('/publisher/{publisher}', 'AdminController@singlePublisher')->name('admin.publisher-single');
    Route::get('/publisher-banned', 'AdminController@bannedPublisher')->name('admin.publisher-ban');
    Route::get('/mail-publisher/{publisher}', 'AdminController@emailPublisher')->name('admin.publisher-email');
    Route::post('/sendmail-publisher', 'AdminController@sendemailPublisher')->name('admin.publisher-send-email');
    Route::put('/publisher/pass-change/{publisher}', 'AdminController@publisherPasschange')->name('admin.publisher-pass');
    Route::put('/publisher/status/{publisher}', 'AdminController@statupdatePublisher')->name('admin.publisher-status');
    
    
    Route::get('/broadcast', 'AdminController@broadcast')->name('admin.broadcast');
    Route::post('/broadcast/email', 'AdminController@broadcastemail')->name('admin.broadcast-email');
    Route::get('/deposits', 'AdminController@deposits')->name('admin.deposits');
    Route::get('/withdraw-request', 'AdminController@withdrawRequest')->name('admin.withdraw-request');
    Route::get('/withdraw-log', 'AdminController@withdrawLog')->name('admin.withdraw-log');
    Route::put('/withdraw-approve/{withdraw}', 'AdminController@withdrawApprove')->name('admin.withdraw-approve');
    Route::put('/withdraw-cancel/{withdraw}', 'AdminController@withdrawCancel')->name('admin.withdraw-cancel');
    
        
    //Password Change
    Route::get('/change-password', 'AdminController@changePassword')->name('admin.change-password');
    Route::post('/password-update', 'AdminController@updatePassword')->name('admin.password-update');

    //Register New Admin
    Route::get('/new-admin', 'AdminController@newAdmin')->name('admin.new-admin');
    Route::get('/list-admin', 'AdminController@listAdmin')->name('admin.list-admin');
    Route::post('/create-admin', 'AdminController@createAdmin')->name('admin.create-admin');
    Route::delete('/delete-admin/{admin}', 'AdminController@deleteAdmin')->name('admin.delete-admin');

     //Ad plans
     Route::get('/plans', 'AdminController@planIndex')->name('admin.plans');
     Route::post('/plan-store', 'AdminController@planStore')->name('admin.plan-store');
     Route::put('/plan-update/{plan}', 'AdminController@planUpdate')->name('admin.plan-update');
     
     //Ad Types
     Route::get('/ad-types', 'AdminController@adtypes')->name('admin.adtypes');
     Route::post('/type-store', 'AdminController@adStore')->name('admin.ad-store');
     Route::put('/type-update/{adtype}', 'AdminController@adUpdate')->name('admin.ad-update');
     
     //testimonial Content
     Route::get('/testimonial-section', 'FrontendController@testimonialSection')->name('admin.testimonialsection');
     Route::post('/testimonial-store', 'FrontendController@testimonialStore')->name('admin.testimonial-store');
     Route::put('/testimonial-update/{testimonial}', 'FrontendController@testimonialUpdate')->name('admin.testimonial-update');
     Route::put('/testimonial-delete/{testimonial}', 'FrontendController@testimonialDestroy')->name('admin.testimonial-delete');
     
     //Blog Content
     Route::get('/blog-section', 'FrontendController@blogSection')->name('admin.blogsection');
     Route::get('/blog-create', 'FrontendController@blogCreate')->name('admin.blogcreate');
     Route::post('/blog-store', 'FrontendController@blogStore')->name('admin.blog-store');
     Route::get('/blog-single/{blog}', 'FrontendController@blogSingle')->name('admin.blog-single');
     Route::put('/blog-update/{blog}', 'FrontendController@blogUpdate')->name('admin.blog-update');
     Route::put('/blog-delete/{blog}', 'FrontendController@blogDestroy')->name('admin.blog-delete');
     
     //Slider Content
     Route::get('/service-section', 'FrontendController@sliderSection')->name('admin.slidersection');
     Route::post('/service-store', 'FrontendController@sliderStore')->name('admin.slide-store');
     Route::put('/service-update/{slide}', 'FrontendController@sliderUpdate')->name('admin.slide-update');
     Route::put('/service-delete/{slide}', 'FrontendController@sliderDestroy')->name('admin.slide-delete');
     
     //Social Content
     Route::get('/social-section', 'FrontendController@socialSection')->name('admin.socialsection');
     Route::post('/social-store', 'FrontendController@socialStore')->name('admin.social-store');
     Route::put('/social-update/{social}', 'FrontendController@socialUpdate')->name('admin.social-update');
     Route::put('/social-delete/{social}', 'FrontendController@socialDestroy')->name('admin.social-delete');
     
     //FAQ Content
     Route::get('/faq-section', 'FrontendController@faqSection')->name('admin.faqsection');
     Route::post('/faq-store', 'FrontendController@faqStore')->name('admin.faq-store');
     Route::put('/faq-update/{faq}', 'FrontendController@faqUpdate')->name('admin.faq-update');
     Route::put('/faq-delete/{faq}', 'FrontendController@faqDestroy')->name('admin.faq-delete');
     
     //About Content
     Route::get('/about-section', 'FrontendController@aboutSection')->name('admin.aboutsection');
     Route::post('/about-update', 'FrontendController@aboutUpdate')->name('admin.about-update');
    
     //Banner Content
     Route::get('/banner-section', 'FrontendController@bannerSection')->name('admin.bannersection');
     Route::post('/banner-update', 'FrontendController@bannerUpdate')->name('admin.banner-update');
     
     //Footer Content
     Route::get('/footer-section', 'FrontendController@footerSection')->name('admin.footersection');
     Route::post('/footer-update', 'FrontendController@footerUpdate')->name('admin.footer-update');

     //headings
     Route::get('/stat-section', 'FrontendController@statSection')->name('admin.statsection');
     Route::post('/service-heading', 'FrontendController@serviceHeading')->name('admin.service-heading');
     Route::post('/testim-heading', 'FrontendController@testimHeading')->name('admin.testim-heading');
     Route::post('/stat-section', 'FrontendController@statHeading')->name('admin.stat-section');
     Route::post('/faq-heading', 'FrontendController@faqHeading')->name('admin.faq-heading');

     // Features
     Route::get('/feature-services', 'FrontendController@featureSection')->name('admin.featuresection');
     Route::post('/feature-heading', 'FrontendController@featureHeading')->name('admin.feature-heading');
     Route::post('/feature-store', 'FrontendController@featureStore')->name('admin.feature-store');
     Route::put('/feature-update/{feature}', 'FrontendController@featureUpdate')->name('admin.feature-update');
     Route::put('/feature-delete/{feature}', 'FrontendController@featureDestroy')->name('admin.feature-delete');
    });
   });

//Admin Auth
Route::prefix('admin')->group(function() {
  Route::get('/', 'AdminController@showLoginForm')->name('admin.login')->middleware('guest:admin');
  Route::post('/login', 'AdminController@login')->name('admin.loginpost')->middleware('guest:admin');
  Route::post('/logout', 'AdminController@logout')->name('admin.logout');
  
});


//Feed Auth
Route::prefix('feed')->group(function() {
    Route::get('/', 'CommunityController@showLoginForm')->name('feed.login')->middleware('guest:feed');
    Route::post('/login', 'CommunityController@login')->name('feed.loginpost')->middleware('guest:feed');
    Route::get('/register', 'CommunityController@showRegistrationForm')->name('feed.register')->middleware('guest:feed');
    Route::post('/register-post', 'CommunityController@register')->name('feed.registerpost')->middleware('guest:feed');
    Route::post('/logout', 'CommunityController@logout')->name('feed.logout');
   
    //Feed verification
    Route::get('/verification', 'CommunityController@memberVerification')->name('feed.verify');       
    Route::post('/send-vcode', 'CommunityController@sendVcode')->name('feed.send-vcode');        
    Route::post('/email-verify', 'CommunityController@emailVerify')->name('feed.email-verify');        
    Route::post('/sms-verify', 'CommunityController@smsVerify')->name('feed.sms-verify'); 

    //Password Reset
    Route::get('/password-reset', 'CommunityController@resetEmail')->name('feed.password.resetreq');        
    Route::post('/password-sendemail', 'CommunityController@sendEmail')->name('feed.password.sendemail');        
    Route::get('/password-reset/{token}', 'CommunityController@resetForm')->name('feed.password.resetform');        
    Route::post('/reset-password', 'CommunityController@resetPassword')->name('feed.password.resetpassword');

    //Public Forums
    Route::get('/dashboard', 'CommunityController@dashboard')->name('feed.dashboard');
    Route::get('/search-post', 'CommunityController@searchPost')->name('feed.searchpost');
    Route::get('/{slug}', 'CommunityController@fetchActivity')->name('feed.fetch');

    //dynamic dropdown country and states
    Route::get('/cities/{country_id}',array('as'=>'user_register.ajax','uses'=>'CommunityController@cityForCountryAjax'));
    
  });
  Route::group(['middleware' => ['memberauth:feed']], function() {
    Route::group(['prefix' => 'feed'], function () 
    {
        Route::post('/create-activity', 'CommunityController@createActivity')->name('feed.newactivity');
        Route::post('/like-activity', 'CommunityController@likeActivity')->name('feed.postlikes');
        Route::delete('/dislike-activity', 'CommunityController@dislikeActivity')->name('feed.postdislikes');
        Route::post('/like-comment', 'CommunityController@likeComment')->name('feed.commentlikes');
        Route::delete('/dislike-comment', 'CommunityController@dislikeComment')->name('feed.commentdislikes');         
        Route::post('/create-comment', 'CommunityController@createComment')->name('feed.commentpost');
        Route::get('/enquirelatest', 'CommunityController@enquireLatest')->name('feed.enquire');
              
    });
});
