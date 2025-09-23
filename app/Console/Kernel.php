<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync:nas100')->dailyAt('23:30')->withoutOverlapping(10);
        // $schedule->command('sync:vnindex')->dailyAt('06:00')->withoutOverlapping(10);
        // $schedule->command('sync:vnindex')->dailyAt('08:00')->withoutOverlapping(10);
        // $schedule->command('sync:vnindex')->dailyAt('10:00')->withoutOverlapping(10);
        // $schedule->command('sync:vnindex')->dailyAt('12:00')->withoutOverlapping(10);
        $schedule->command('send-profit-today')->dailyAt('23:59')->withoutOverlapping(10);
        $schedule->command('CalculateProfitDaily:greenalpha')->dailyAt('23:55')->withoutOverlapping(10);
        $schedule->command('delete:user')->dailyAt('23:00')->withoutOverlapping(10);
        // $schedule->command('send:promotion')->everyMinute()->withoutOverlapping(10);
//        $schedule->command('send:birthday')->dailyAt('09:30')->withoutOverlapping(10);
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
