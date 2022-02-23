<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('youtube:cron')->everyMinute();
        $schedule->command('telegramMembros:cron')->everyFifteenMinutes();

        $schedule->command('abapBlogPosts:cron')->weeklyOn(1, '11:00');
        $schedule->command('hanaBlogPosts:cron')->weeklyOn(2, '11:00');
        $schedule->command('btpBlogPosts:cron')->weeklyOn(3, '11:00');

        $schedule->command('abapBlogPosts:cron')->weeklyOn(4, '11:00');
        $schedule->command('hanaBlogPosts:cron')->weeklyOn(5, '11:00');
        $schedule->command('btpBlogPosts:cron')->weeklyOn(6, '11:00');

        //$schedule->command('reportClicks:cron')->weeklyOn(5, '12:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
