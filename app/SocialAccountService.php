<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\LinkedSocialAccount;
use App\Member;

class SocialAccountService 
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $account = LinkedSocialAccount::where('provider_name', $provider)
                    ->where('provider_id', $providerUser->getId())
                    ->first();

        if($account)
        {
            return $account->user;
        } else {
            $user = Memmber::where('email', $providerUser->getEmail())->first();

            if(!$user) 
            {
                $gnl = General::first();
                $reg['name'] = $providerUser->getName();
                $reg['email'] = $providerUser->getEmail();
                $reg['username'] = $providerUser->getName();
                $reg['password'] = Hash::make('pass');
                $reg['country'] = "";
                $reg['city'] = "";
                $reg['mobile'] = "";
                $reg['emailv'] = $gnl->emailver;
                $reg['smsv'] = $gnl->smsver;
                $user = Member::create($reg);
            }

            return $user;
        }
    }
}