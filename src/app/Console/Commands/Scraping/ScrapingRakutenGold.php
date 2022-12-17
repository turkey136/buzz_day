<?php

namespace App\Console\Commands\Scraping;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingRakutenGold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingGold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '金・銀・プラチナ価格';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayData = [];
        $client = new Client(HttpClient::create(['timeout' => 10]));
        $crawler = $client->request('GET', 'https://member.rakuten-sec.co.jp/app/info_gold_price_visitor.do?eventType=visitorInit');

        $todayData['gold'] = $this->replacementyen($this->getvalue($crawler, 1));
        $todayData['silver'] = $this->replacementyen($this->getvalue($crawler, 3));
        $todayData['platinum'] =  $this->replacementyen($this->getvalue($crawler, 2));

        // file 出力
        $jsonPath = 'storage/app/public/rakuten_gold.json';
        $jsonData = [];
        if (file_exists($jsonPath)) {
          $data = file_get_contents($jsonPath);
          $jsonData = json_decode($data, true);
        }
        $jsonData[date("Y-m-d")] = $todayData;
        file_put_contents($jsonPath, json_encode($jsonData));

        return 0;
    }

    private function getvalue($crawler, $index)
    {
        return $crawler->filter('tr')->eq($index)->filter('td')->eq(1)->filter('span')->each(function ($node) {
            return $node->text();
        })[0];
    }

    private function replacementyen($value)
    {
      $value = str_replace(',', '', $value);
      return str_replace('±ß/g', '', $value);
    }
}
