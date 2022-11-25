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
      // PM 11:00 代
      $schedule->command('command:scrapingYoutube')->dailyAt('23:30');
      $schedule->command('command:scrapingNiconico')->dailyAt('23:30');
      $schedule->command('command:scrapingPorn')->dailyAt('23:30');
      $schedule->command('command:scrapingNarou')->dailyAt('23:30');

      // AM 1:00 代
      $schedule->command('command:totallingSbiInvestmentTrust')->dailyAt('1:00');

      // tweet
      $schedule->command('command:tweetTotallingSbiInvestmentTrust commodity')->dailyAt('9:00');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust etc')->dailyAt('9:10');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust balance')->dailyAt('9:20');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust bull_bear')->dailyAt('9:30');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust hedge_fund')->dailyAt('9:40');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust world_reit')->dailyAt('9:50');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust world_stock')->dailyAt('1:00');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust world_bond')->dailyAt('10:10');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust jp_reit')->dailyAt('10:20');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust jp_stock')->dailyAt('10:30');
      $schedule->command('command:tweetTotallingSbiInvestmentTrust jp_bond')->dailyAt('10:40');

      //
      $schedule->command('command:scrapingSbiInvestmentTrust')->everyFourHours();
      $schedule->command('command:scrapingRakutenEtf')->everyFourHours();
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
