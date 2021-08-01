<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SocialAccountService;

class SocialAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(SocialAccountService $accountService)
    {
        try {
            $user = \Socialite::with($provider)->user();
        } catch (\Exception $e){
            return redirect('feed.login');
        }

        $authUser = $accountService->findOrCreate(
            $user,
            $provider
        );

        auth()->login($authUser, true);

        return redirect()->to('feed.dashboard');
    }
}
