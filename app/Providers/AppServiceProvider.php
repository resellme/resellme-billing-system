<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Modules\CP\CPInterface;
use Modules\CP\Resellme\ResellmeCP;
use Modules\DomainRegistra\DomainRegistrarInterface;
use Modules\DomainRegistra\Resellme\ResellmeRegistrar;
use Modules\PaymentGateway\PaymentGatewayInterface;
use Modules\PaymentGateway\Paynow\PaynowPaymentGateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HostingInterface::class, ResellmeHosting::class);
        $this->app->bind(DomainRegistrarInterface::class, ResellmeRegistrar::class);
        $this->app->bind(PaymentGatewayInterface::class, PaynowPaymentGateway::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(125);
    }
}
