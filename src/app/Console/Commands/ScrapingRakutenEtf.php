<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingRakutenEtf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingRakutenEtf';

    /**Goutte
     * The console command description.
     *
     * @var string
     */
    protected $description = '楽天証券米国株一覧取得';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         // see
         //   https://www.rakuten-sec.co.jp/web/market/search/etf_search/?form-text-01=&mktch_us=on&mktch_hk=on&mktch_sg=on
        $rakutenDir = base_path('storage/app/public/rakuten_etf/' . date("Y") . "/" .  date("m"));
        if (! file_exists($rakutenDir)) {
          mkdir($rakutenDir, 0777, true);
        }
        $stockListFilePath = $rakutenDir . '/' . date("Ymd") .  '.csv';
        system('curl -o ' . $stockListFilePath . '  https://www.rakuten-sec.co.jp/web/market/search/etf_search/ETFD.csv');

        return 0;
    }

    private function getStockList()
    {

    }
}
