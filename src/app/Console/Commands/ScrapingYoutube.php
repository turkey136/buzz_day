<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google_Client;
use Google_Service_YouTube;

class ScrapingYoutube extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingYoutube';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayData = [];
        $search_results = $this->getYoutubeData();
        foreach ($search_results['items'] as $search_result) {
            $todayData = [
                'videoId' => $search_result['id'],
                'title' => $search_result['snippet']['title'],
                'description' => $search_result['snippet']['description'],
                'channelId' => $search_result['snippet']['channelId'],
                'channelName' => $search_result['snippet']['channelTitle'],
            ];
        }

        // file 出力
        $youtubeJsonFilePath = 'storage/app/public/buzz_tube.json';
        $buzzTubeData = [];
        if (file_exists($youtubeJsonFilePath)) {
          $buzzTubeData = file_get_contents($youtubeJsonFilePath);
          $buzzTubeData = json_decode($buzzTubeData, true);
        }
        $buzzTubeData[date("Y-m-d")] = $todayData;
        file_put_contents($youtubeJsonFilePath, json_encode($buzzTubeData));

        return 0;
    }

    private function getYoutubeData()
    {
        $client = new Google_Client();
        $client->setDeveloperKey(env('YOUTUBE_KEY'));
        $youtube = new Google_Service_YouTube($client);
         $part = ['snippet'];
        $params = [
            'chart' => 'mostPopular',
            'maxResults' => 1,
            'regionCode' => 'JP',
        ];

        return $youtube->videos->listVideos($part, $params);
    }
}
