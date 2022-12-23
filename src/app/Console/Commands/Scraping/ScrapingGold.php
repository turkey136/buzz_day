<?php

namespace App\Console\Commands\Scraping;

use Illuminate\Console\Command;
use Carbon\Carbon;

class ScrapingGold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scrapingGold {year?} {month?}';

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
        $year = $this->argument('year') ?? date('Y');
        $month = $this->argument('month');
        $fromMonth = '01';
        $toMonth = '12';
        if(!empty($month)) {
            $fromMonth = $month;
            $toMonth = $month;
        }
        $from = new Carbon($year.'-'.$fromMonth.'-01');
        $to = new Carbon($year.'-'.$toMonth.'-01');

        $data = [
          'gold' => [],
          'silver' => [],
          'platinum' => [],
        ];
        $jsonPath = 'storage/app/public/gold.json';
        if (file_exists($jsonPath)) {
          $data = file_get_contents($jsonPath);
          $data = json_decode($data, true);
        }

        while($from <= $to) {
          $tmpData = $this->getJsonData($from->format('Ym'));

          foreach($tmpData as $index => $value) {
            if(empty($value)) { continue; }
            $goldValue = $this->replacementComma($value['nj_buy']['ingod']['au']['price']);
            if (!empty($goldValue) && '-' !== $goldValue) {
                $diff =  $value['nj_buy']['ingod']['au']['diff'];
                $data['gold'][$index] = [
                    'price' => $goldValue,
                    'diff' => $diff,
                    'diff_percent' => (float)$goldValue / ((float)$goldValue - (float)$diff) - 1,
                ];
            }

            $silverValue = $this->replacementComma($value['nj_buy']['ingod']['ag']['price']);
            if (!empty($silverValue) && '-' !== $silverValue) {
                $diff = $value['nj_buy']['ingod']['ag']['diff'];
                $data['silver'][$index] =
                [
                    'price' => $silverValue,
                    'diff' => $diff,
                    'diff_percent' => (float)$silverValue / ((float)$silverValue - (float)$diff) - 1,
                ];
            }

            $platinumValue = $this->replacementComma($value['nj_buy']['ingod']['pt']['price']);
            if (!empty($platinumValue) && '-' !== $platinumValue) {
                $diff = $value['nj_buy']['ingod']['pt']['diff'];
                $data['platinum'][$index] = [
                    'price' => $platinumValue,
                    'diff' => $diff,
                    'diff_percent' =>  (float)$platinumValue / ((float)$platinumValue - (float)$diff) - 1,
                ];

            }
          }
          $from = $from->addMonth();
        }

        // file 出力
        file_put_contents($jsonPath, json_encode($data));

        return 0;
    }

    private function getJsonData($getDate)
    {
        $url = 'https://www.net-japan.co.jp/system/upload/netjapan/export/price_'.$getDate.'.json';
        print $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res =  curl_exec($ch);
        $json = json_decode($res, true);
        curl_close($ch);
        return $json;
    }

    private function replacementComma($value)
    {
        return str_replace(',', '', $value);
    }
}
