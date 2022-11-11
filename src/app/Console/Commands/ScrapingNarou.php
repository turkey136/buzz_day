<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingNarou extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingNarou';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ニコニコ動画 ランキング1位取得';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayData = [];
        $client = new Client(HttpClient::create(['timeout' => 10]));
        $crawler = $client->request('GET', 'https://yomou.syosetu.com/rank/genretop/#genre_daily');

        $todayData = $crawler->filter('div.genreranking_topbox')->each(function ($node) {
            return [
              'title' => $node->filter('li')->eq(0)->filter('a')->eq(0)->text(),
              'url' => $node->filter('li')->eq(0)->filter('a')->eq(0)->attr('href'),
              'category' => $node->filter('h3')->text(),
              'owner_url' => $node->filter('li')->eq(0)->filter('a')->eq(1)->attr('href'),
              'owner' => $node->filter('li')->eq(0)->filter('a')->eq(1)->text()
            ];
        });

        // file 出力
        $narouJsonFilePath = 'storage/app/public/buzz_narou.json';
        $data = [];
        if (file_exists($narouJsonFilePath)) {
          $data = file_get_contents($narouJsonFilePath);
          $data = json_decode($data, true);
        }
        $data[date("Y-m-d")] = $todayData;
        file_put_contents($narouJsonFilePath, json_encode($data));

        return 0;
    }
}
