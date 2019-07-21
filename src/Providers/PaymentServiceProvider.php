<?php

namespace Hongyukeji\LaravelPayment\Providers;

use Hongyukeji\LaravelPayment\Payment;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Payment::class, function ($app) {
            return new Payment($app->config->get('payments', []));
        });

        $this->app->alias(Payment::class, 'payment');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
