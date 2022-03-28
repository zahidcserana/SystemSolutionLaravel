<?php

namespace App\Providers;

use App\Components\PaymentComponent;
use Illuminate\Support\ServiceProvider;

class PaymentComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('payment', function () {
            return new PaymentComponent();
        });
    }

    public function provides()
    {
        return [
            'payment'
        ];
    }
}
