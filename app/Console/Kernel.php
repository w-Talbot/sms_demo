<?php

namespace App\Console;

use App\Console\Commands\DeleteOldUsers;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('CheckRecurringAlerts:run')->dailyAt('09:00')->withoutOverlapping();
        $schedule->command('CheckNewAlerts:run')->dailyAt('09:00')->withoutOverlapping();

        //TESTING:
//        $schedule->command('CheckRecurringAlerts:run')
//            ->dailyAt('15:19');
//
//        $schedule->command('CheckNewAlerts:run')
//            ->dailyAt('15:19');
        //END

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
