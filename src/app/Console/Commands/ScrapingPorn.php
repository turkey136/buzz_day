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
            'porn_hub_jp_a_hot' => $this->scrapingPornHub('homemade', 'jp', 'ht'),
            'porn_hub_jp_p_hot' => $this->scrapingPornHub('professional', 'jp', 'ht'),
            'porn_hub_world_a_hot' => $this->scrapingPornHub('homemade', '', 'ht'),
            'porn_hub_world_p_hot' => $this->scrapingPornHub('professional', '', 'ht'),
            'porn_hub_jp_a_mv' => $this->scrapingPornHub('homemade', 'jp', 'mv'),
            'porn_hub_jp_p_mv' => $this->scrapingPornHub('professional', 'jp', 'mv'),
            'porn_hub_world_a_mv' => $this->scrapingPornHub('homemade', '', 'mv'),
            'porn_hub_world_p_mv' => $this->scrapingPornHub('professional', '', 'mv'),
            'tk_tube_viewed' => $this->scrapingTkTube('viewed'),
            'tk_tube_rating' => $this->scrapingTkTube('rating'),
            'javmix_soaring' => $this->scrapingJavmix('soaring'),
            'javmix_popularity' => $this->scrapingJavmix('popularity'),
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

    private function scrapingJavmix($type)
    {
        $client = new Client(HttpClient::create(['timeout' => 100]));
        $url = 'https://javmix.tv/' . $type . '/';

        $crawler = $client->request('GET', $url);
        return $crawler->filter('a')->eq(17)->each(function ($node){
            return [
              'url' => $node->attr('href'),
              'title' =>  $node->filter('span')->eq(0)->text(),
              'img' => $node->filter('img')->eq(0)->attr('src'),
              'owner' => 'unknown',
              'owner_url' => 'nonthing'
            ];
        })[0];
    }

    private function scrapingTkTube($type)
    {
        $client = new Client(HttpClient::create(['timeout' => 100]));
        $url = '';
        if ('viewed' === $type ) {
            $url = 'https://www.tktube.com/most-popular/?mode=async&function=get_block&block_id=list_videos_common_videos_list&sort_by=video_viewed_today';
        } else if ('rating' === $type) {
            $url = 'https://www.tktube.com/top-rated/?mode=async&function=get_block&block_id=list_videos_common_videos_list&sort_by=rating_today';
        }

        $crawler = $client->request('GET', $url);
        return $crawler->filter('a')->eq(3)->each(function ($node){
            return [
              'url' => $node->attr('href'),
              'title' => $node->filter('strong')->eq(0)->text(),
              'img' => $node->filter('img')->eq(0)->attr('src'),
              'owner' => 'unknown',
              'owner_url' => 'nonthing'
            ];
        })[0];
    }

    private function scrapingPornHub($production, $country, $type)
    {
        $client = new Client(HttpClient::create(['timeout' => 100]));
        $url = 'https://jp.pornhub.com/video?o=' . $type . '&p=' . $production;
        if ("" !== $country) {
            $url = $url . '&cc=' . $country;
        }
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
