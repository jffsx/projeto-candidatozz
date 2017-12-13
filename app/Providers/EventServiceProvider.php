<?php

namespace Candidatozz\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Candidatozz\Events\SomeEvent' => [
            'Candidatozz\Listeners\EventListener',
        ],
    ];
}
