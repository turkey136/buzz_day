<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Yasumi\Yasumi;
use Illuminate\Support\Carbon;

class TotallingSbiInvestmentTrust extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:totallingSbiInvestmentTrust {date?}';

    /**
     * @var string
     */
    protected $description = 'SBI 投資信託集計';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = $this->baseDate();
        $data = $this->summary($date);

        // file 出力
        $csvFilePath = 'storage/app/public/totalling_sbi_investment_trust.json';
        $InvestmentTrust = [];
        if (file_exists($csvFilePath)) {
          $InvestmentTrust = file_get_contents($csvFilePath);
          $InvestmentTrust = json_decode($InvestmentTrust, true);
        }
        $InvestmentTrust[$this->baseDate()->format("Y-m-d")] = $data;
        file_put_contents($csvFilePath, json_encode($InvestmentTrust));

        return 0;
    }

    protected function summary($yesterday) {
        $data = [];
        $tmpData = $this->emptySummarydate();
        $count = 0;
        while ($count < 3) {
          if (! $this->isHoliday($yesterday)) {
            $filePath =  base_path('storage/app/public/sbi_investment_trust/' . (string)($yesterday->year) . '/' . (string)$yesterday->month . '/' . (string)$yesterday->format("Ymd") . '.csv');
            if (! file_exists($filePath)) {
                $yesterday = $yesterday->subDay();
                continue;
            }

            $csv = $this->loadCsv($yesterday, $filePath);
            foreach ($csv as $index => $value) {
                $prices = $value['price'];
                $day_before_ratios = $value['day_before_ratio'];
                if (0 === $count) {
                    $data[$index] = [
                        'avg_price' => $this->avg($prices),
                        'avg_day_before_ratio' =>  $this->avg($day_before_ratios),
                    ];
                }

                $tmpData[$index]['price'] = array_merge($tmpData[$index]['price'], $prices);
                $tmpData[$index]['day_before_ratio'] = array_merge($tmpData[$index]['day_before_ratio'], $day_before_ratios);
            }

            $count = $count + 1;
          }
          $yesterday = $yesterday->subDay();
        }
        foreach ($tmpData as $index => $value) {
            $data[$index]['price_3day'] = $this->avg($value['price']);
            $data[$index]['day_before_ratio_3day'] = $this->avg($value['day_before_ratio']);
        }

        return $data;
    }

    protected function isHoliday($date)
    {
        if (in_array((string)$date->dayOfWeek, ['0', '6'])) {
          return true;
        }

        $holidays = Yasumi::create('Japan', $date->year);
        return $holidays->isHoliday($date);
    }

    protected function loadCsv($date, $filePath)
    {
        $data = $this->emptySummarydate();

        if (($fp = fopen($filePath, 'r')) !== FALSE){
            $row = 0;
            while (($line = fgetcsv($fp)) !== FALSE) {
              if (4 < $row) {
                  array_unshift($data[$line[13]]['price'], $line[16]);
                  array_unshift($data[$line[13]]['day_before_ratio'],  $line[17]);
              }
              $row++;
            }
        }
        fclose($fp);

        return $data;
    }

    protected function baseDate()
    {
      $date = $this->argument('date');
      if (empty($date)) {
          return Carbon::yesterday();
      } else {
          return (new Carbon($date))->subDay();
      }
    }

    protected function emptySummarydate()
    {
      return [
          "コモディティ" =>  ['price' => [], 'day_before_ratio' => []],
          "その他" =>  ['price' => [], 'day_before_ratio' => []],
          "バランス" => ['price' => [], 'day_before_ratio' => []],
          "ブル・ベア" => ['price' => [], 'day_before_ratio' => []],
          "ヘッジファンド" =>  ['price' => [], 'day_before_ratio' => []],
          "国際REIT" =>  ['price' => [], 'day_before_ratio' => []],
          "国内REIT" =>  ['price' => [], 'day_before_ratio' => []],
          "国際株式" =>  ['price' => [], 'day_before_ratio' => []],
          "国際債券" =>  ['price' => [], 'day_before_ratio' => []],
          "国内株式" =>  ['price' => [], 'day_before_ratio' => []],
          "国内債券" =>  ['price' => [], 'day_before_ratio' => []],
        ];
    }

    protected function avg($arr)
    {
      if (0 === count($arr)) {
        return 0;
      }
      return floor (array_sum($arr) / count($arr));
    }
}
