<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\PostCreated;
use App\Events\PostUpdated;
use App\Listeners\UpdatePostSlug;
use App\Listeners\UpdateEditUser;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PostCreated::class => [
            UpdatePostSlug::class,
        ],
        PostUpdated::class => [
            UpdatePostSlug::class,
            UpdateEditUser::class
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
