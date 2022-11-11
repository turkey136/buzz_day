<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingPorn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingPorn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'アダルト動画1位取得';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayData = [
            'porn_hub_jp_a' => $this->scrapingPornHub('homemade', 'jp'),
            'porn_hub_jp_p' => $this->scrapingPornHub('professional', 'jp'),
            'porn_hub_world_a' => $this->scrapingPornHub('homemade', ''),
            'porn_hub_world_p' => $this->scrapingPornHub('professional', ''),
        ];

        // file 出力
        $pornJsonFilePath = 'storage/app/public/buzz_porn.json';
        $data = [];
        if (file_exists($pornJsonFilePath)) {
          $data = file_get_contents($pornJsonFilePath);
          $data = json_decode($data, true);
        }
        $data[date("Y-m-d")] = $todayData;
        file_put_contents($pornJsonFilePath, json_encode($data));

        return 0;
    }

    private function scrapingPornHub($production, $country)
    {
        $client = new Client(HttpClient::create(['timeout' => 10]));
        $url = 'https://jp.pornhub.com/video?o=ht&p=' . $production;
        if ("" !== $country) {
            $url = $url . '&cc=' . $country;
        }
                echo $url;
        $crawler = $client->request('GET', $url);

        return $crawler->filter('#videoCategory')->filter('li')->eq(1)->each(function ($node){
            return [
              'url' => 'https://jp.pornhub.com'. $node->filter('a')->eq(0)->attr('href'),
              'title' => $node->filter('img')->eq(0)->attr('alt'),
              'img' => $node->filter('img')->eq(0)->attr('data-mediumthumb'),
              'owner' => $node->filter('a')->eq(2)->text(),
              'owner_url' => 'https://jp.pornhub.com'. $node->filter('a')->eq(2)->attr('href')
            ];
        })[0];
    }
}
