<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\OrderCompleted;
use App\Listeners\ProcessOrder;
use App\Listeners\SendOrderCompletedNotificationToClient;
use App\Listeners\SendOrderCompletedNotificationToAdmin;
use App\Listeners\SendUserCreatedNotificationToAdmin;
use App\Listeners\ProvisionHosting;
use App\Listeners\RegisterDomain;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendUserCreatedNotificationToAdmin::class,
        ],
        OrderCompleted::class => [
            ProvisionHosting::class,
            RegisterDomain::class,
            SendOrderCompletedNotificationToAdmin::class,
            SendOrderCompletedNotificationToClient::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
