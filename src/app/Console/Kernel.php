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
        // 情報の取得
        $schedule->command('command:scrapingYoutube')->dailyAt('23:30');
        $schedule->command('command:scrapingNiconico')->dailyAt('23:30');
        $schedule->command('command:scrapingPorn')->dailyAt('23:30');
        $schedule->command('command:scrapingNarou')->dailyAt('23:30');
        $schedule->command('command:scrapingSbiInvestmentTrust')->everyFourHours();
        $schedule->command('command:scrapingRakutenEtf')->everyFourHours();
        $schedule->command('command:scrapingGold')->dailyAt('10:00');

        // 情報の加工
        $schedule->command('command:totallingSbiInvestmentTrust')->dailyAt('1:00');

        // tweet 投資信託
        $schedule->command('command:tweetTotallingSbiInvestmentTrust commodity')->dailyAt('9:00');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust etc')->dailyAt('9:10');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust balance')->dailyAt('9:20');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust bull_bear')->dailyAt('9:30');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust hedge_fund')->dailyAt('9:40');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust world_reit')->dailyAt('9:50');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust world_stock')->dailyAt('10:00');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust world_bond')->dailyAt('10:10');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust jp_reit')->dailyAt('10:20');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust jp_stock')->dailyAt('10:30');
        $schedule->command('command:tweetTotallingSbiInvestmentTrust jp_bond')->dailyAt('10:40');
        // tweet ETF
        $schedule->command('command:tweetEtfDifference asia_pus')->dailyAt('17:00');
        $schedule->command('command:tweetEtfDifference asia_pus_ex_jpm')->dailyAt('17:05');
        $schedule->command('command:tweetEtfDifference asia_ex_jpn')->dailyAt('17:10');
        $schedule->command('command:tweetEtfDifference africa')->dailyAt('17:15');
        $schedule->command('command:tweetEtfDifference usa')->dailyAt('17:20');
        $schedule->command('command:tweetEtfDifference gbr')->dailyAt('17:25');
        $schedule->command('command:tweetEtfDifference ind')->dailyAt('17:30');
        $schedule->command('command:tweetEtfDifference idn')->dailyAt('17:35');
        $schedule->command('command:tweetEtfDifference aus')->dailyAt('17:40');
        $schedule->command('command:tweetEtfDifference g_china')->dailyAt('17:45');
        $schedule->command('command:tweetEtfDifference global')->dailyAt('17:50');
        $schedule->command('command:tweetEtfDifference global_ex_usa')->dailyAt('17:55');
        $schedule->command('command:tweetEtfDifference sgp')->dailyAt('18:00');
        $schedule->command('command:tweetEtfDifference swe')->dailyAt('18:05');
        $schedule->command('command:tweetEtfDifference tha')->dailyAt('18:10');
        $schedule->command('command:tweetEtfDifference tur')->dailyAt('18:15');
        $schedule->command('command:tweetEtfDifference geu')->dailyAt('18:20');
        $schedule->command('command:tweetEtfDifference pak')->dailyAt('18:25');
        $schedule->command('command:tweetEtfDifference phl')->dailyAt('18:30');
        $schedule->command('command:tweetEtfDifference fra')->dailyAt('18:35');
        $schedule->command('command:tweetEtfDifference bra')->dailyAt('18:40');
        $schedule->command('command:tweetEtfDifference vnm')->dailyAt('18:45');
        $schedule->command('command:tweetEtfDifference pol')->dailyAt('18:50');
        $schedule->command('command:tweetEtfDifference mys')->dailyAt('18:55');
        $schedule->command('command:tweetEtfDifference mex')->dailyAt('19:00');
        $schedule->command('command:tweetEtfDifference eur')->dailyAt('19:05');
        $schedule->command('command:tweetEtfDifference europa')->dailyAt('19:10');
        $schedule->command('command:tweetEtfDifference latin_america')->dailyAt('19:15');
        //$schedule->command('command:tweetEtfDifference rus')->dailyAt('19:20');
        $schedule->command('command:tweetEtfDifference china')->dailyAt('19:25');
        $schedule->command('command:tweetEtfDifference zaf')->dailyAt('19:30');
        $schedule->command('command:tweetEtfDifference twn')->dailyAt('19:35');
        $schedule->command('command:tweetEtfDifference emergent_countries')->dailyAt('19:40');
        $schedule->command('command:tweetEtfDifference jpn')->dailyAt('19:45');
        $schedule->command('command:tweetEtfDifference kor')->dailyAt('19:50');
        $schedule->command('command:tweetEtfDifference hkg')->dailyAt('19:55');
        $schedule->command('command:tweetEtfDifference all')->dailyAt('20:00');
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
