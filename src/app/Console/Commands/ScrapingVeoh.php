<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingVeoh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingVeoh';

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
        $crawler = $client->request('GET', 'https://www.veoh.com/');

        // video 情報取得
        $todayData['videoId'] = $this->takeOutVideoId($crawler);
        $todayData['title'] = $this->takeOutAttr($crawler, 'div.NC-Thumbnail-image', 'aria-label');
        $todayData['image'] = $this->takeOutAttr($crawler, 'div.NC-Thumbnail-image', 'data-background-image');
        $todayData['description'] = $this->takeOutDescription($crawler);

        // 投稿者情報取得
        $ownerData = $this->takeOutOwner($client, $todayData['videoId'])[0];
        $todayData['channelName'] = $ownerData->name;
        $todayData['channelId'] = preg_replace('/https:\/\/www.nicovideo.jp\/user\//', '', $ownerData->url);

        // file 出力
        $youtubeJsonFilePath = 'storage/app/public/buzz_niconico.json';
        $buzzNiconicoData = [];
        if (file_exists($youtubeJsonFilePath)) {
          $buzzNiconicoData = file_get_contents($youtubeJsonFilePath);
          $buzzNiconicoData = json_decode($buzzNiconicoData, true);
        }
        $buzzNiconicoData[date("Y-m-d")] = $todayData;
        file_put_contents($youtubeJsonFilePath, json_encode($buzzNiconicoData));

        return 0;
    }

    private function takeOutAttr($crawler, $filter, $returnData)
    {
        return $crawler->filter($filter)->eq(1)->each(function ($node) use($returnData) {
            return $node->attr($returnData);
        })[0];
    }

    private function takeOutVideoId($crawler)
    {
        return $crawler->filter('div.NC-MediaObject-main > a')->eq(1)->each(function ($node) {
            return str_replace('https://www.nicovideo.jp/watch/', '', $node->attr('href'));
        })[0];
    }

    private function takeOutDescription($crawler)
    {
        return $crawler->filter('div.NC-VideoMediaObject-description')->eq(0)->each(function ($node) {
            return $node->text();
        })[0];
    }

    private function takeOutOwner($client, $videoId)
    {
        $url =  'https://www.nicovideo.jp/watch/' . $videoId;
        $crawler = $client->request('GET', $url);
        return $crawler->each(function ($node) {
            $ownerData = preg_replace("/.+author\":/", "", $node->text());
            $ownerData = preg_replace("/}.+/", "}", $ownerData);
            return json_decode($ownerData);
        });
    }
}
