<?php

namespace App\Providers;

use App\Events\{CompleteTaskEvent, TransactionEvent};
use App\Listeners\{CompleteTaskListener, TransactionListener};
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TransactionEvent::class => [
            TransactionListener::class,
        ],
        CompleteTaskEvent::class => [
            CompleteTaskListener::class
        ],
    ];
}
