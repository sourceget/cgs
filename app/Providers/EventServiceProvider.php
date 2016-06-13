<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Illuminate\Database\Events\QueryExecuted::class => [
            \App\Listeners\LogSql::class
        ],
        'eloquent.booting: Modules\Department\Entities\Admin' => [
            \App\Listeners\AdminListener::class,
        ],
        'eloquent.booting: Modules\Department\Entities\Department' => [
            \App\Listeners\DepartmentListener::class,
        ],
        \App\Events\TaoBaoEvent::class => [
            \App\Listeners\TaoBaoListener::class,
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events) {
        parent::boot($events);

        //
    }

}
