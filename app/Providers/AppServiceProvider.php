<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        View::composer('layouts.dashboard', function ($view) {
            $currentGuard = session('guard');
            $view->with([
                'admin' => $currentGuard === 'admin',
                'developer' => $currentGuard === 'developer',
                'sales' => $currentGuard === 'sales',
                'projectmanager' => $currentGuard === 'projectmanager',
                'customer' => $currentGuard === 'customer',
            ]);
        });
    }
}
