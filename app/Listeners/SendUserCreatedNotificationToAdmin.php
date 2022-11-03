<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\UserCreatedAdminNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class SendUserCreatedNotificationToAdmin implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        $admins = User::where([
            'user_type' => 'admin'
        ])->get();

        Notification::send($admins, new UserCreatedAdminNotification($user));
    }

    public $delay = 20;
}
