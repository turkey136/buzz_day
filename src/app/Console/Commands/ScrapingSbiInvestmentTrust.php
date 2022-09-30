<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingSbiInvestmentTrust extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingSbiInvestmentTrust';

    /**Goutte
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SBI 投資信託一覧取得';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayData = [];
        $client = new Client(HttpClient::create(['timeout' => 10]));
        $crawler = $client->request('GET', 'https://site0.sbisec.co.jp/marble/fund/powersearch/fundpsearch.do?');
        $form = $crawler->filter('form#conditionForm')->eq(0)->each(function ($node) {
            return $node->form();
        });
        $postParams = $form[0]->getValues();
        $client->request('POST', 'https://site0.sbisec.co.jp/marble/fund/powersearch/fundpsearch/csv.do', $postParams);
        $csv_download_response = $client->getResponse()->getContent();

        // file 出力
        $csvDir = base_path('storage/app/public/sbi_investment_trust/' . date("Y") . "/" .  date("m"));
        if (! file_exists($csvDir)) {
          mkdir($csvDir, 0777, true);
        }
        $csvFilePath = $csvDir . '/' . date("Ymd") . '.csv';
        file_put_contents($csvFilePath, mb_convert_encoding($csv_download_response, "UTF-8", "SJIS"));

        return 0;
    }
}
