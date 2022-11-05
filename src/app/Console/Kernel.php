<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->command(' command:scrapingYoutube')->dailyAt('23:30');
      $schedule->command(' command:scrapingNiconico')->dailyAt('23:30');
      $schedule->command(' command:scrapingPorn')->dailyAt('23:30');
      $schedule->command(' command:scrapingNarou')->dailyAt('23:30');
      $schedule->command(' command:scrapingSbiInvestmentTrust')->dailyAt('23:00');
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
