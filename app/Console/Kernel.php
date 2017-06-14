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
        Commands\RunAmazonCron::class,
        Commands\UpdateInventory::class
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
        $schedule->command('RunAmazonCron:RunAmazonCron')->cron('44 05 * * * *');
        $schedule->command('RunAmazonCron:RunAmazonCron')->cron('59 23 * * * *');
        $schedule->command('RunAmazonCron:RunAmazonCron')->cron('59 07 * * * *');
        $schedule->command('RunAmazonCron:RunAmazonCron')->cron('59 03 * * * *');
        $schedule->command('RunAmazonCron:RunAmazonCron')->cron('08 06 * * * *');
        $schedule->command('RunAmazonCron:RunAmazonCron')->twiceDaily(7, 19);
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
