<?php

namespace App\Providers;

use Braintree\Configuration;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Configuration::environment(config('services.braintree.environment'));
        Configuration::merchantId(config('services.braintree.merchant_id'));
        Configuration::publicKey(config('services.braintree.public_key'));
        Configuration::privateKey(config('services.braintree.private_key'));

    }
}
