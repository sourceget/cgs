<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Modules\GenerateModuleCommand::class,
        \App\Console\Commands\Modules\GenerateApplicationCommand::class,
        \App\Console\Commands\Modules\GenerateRepositoryCommand::class,
        \App\Console\Commands\Modules\GenerateRequestCommand::class,
        \App\Console\Commands\Modules\GenerateTraitCommand::class,
        \App\Console\Commands\Modules\GenerateServiceCommand::class,
        \App\Console\Commands\Modules\GenerateControllerCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }
}
