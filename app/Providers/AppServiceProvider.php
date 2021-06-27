<?php

namespace App\Providers;

use App\General;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $gnl = General::first();
        if(is_null($gnl))
        {
            $default = [
                'title' => 'KITKIT',
                'subtitle' => 'Subtitle',
                'color' => '009933',
                'cur' => 'USD',
                'cursym' => '$',
                'decimal' => '2',
                'reg' => '1',
                'emailver' => '1',
                'smsver' => '1',
                'emailnotf' => '0',
                'smsnotf' => '0'
            ];
            General::create($default);
            $gnl = General::first();
        }
        view()->share('gnl',  $gnl);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
