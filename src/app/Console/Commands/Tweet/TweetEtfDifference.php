<?php

namespace App\Console\Commands\Tweet;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Abraham\TwitterOAuth\TwitterOAuth;
use Yasumi\Yasumi;

class TweetEtfDifference extends Command
{
    const TYPE = [
        'asia_pus' => 'アジア パシフィック',
        'asia_pus_ex_jpm' => 'アジア パシフィック（除く日本）',
        'asia_ex_jpn' => 'アジア（除く日本）',
        'africa' => 'アフリカ',
        'usa' => 'アメリカ',
        'gbr' => 'イギリス',
        'ind' => 'インド',
        'idn' => 'インドネシア',
        'aus' => 'オーストラリア',
        'g_china' => 'グレーターチャイナ',
        'global' => 'グローバル',
        'global_ex_usa' => 'グローバル（除くアメリカ）',
        'sgp' => 'シンガポール',
        'swe' => 'スイス',
        'tha' => 'タイ',
        'tur' => 'トルコ',
        'geu' => 'ドイツ',
        'pak' => 'パキスタン',
        'phl' => 'フィリピン',
        'fra' => 'フランス',
        'bra' => 'ブラジル',
        'vnm' => 'ベトナム',
        'pol' => 'ポーランド',
        'mys' => 'マレーシア',
        'mex' => 'メキシコ',
        'eur' => 'ユーロ',
        'europa' => 'ヨーロッパ',
        'latin_america' => 'ラテンアメリカ',
        'rus' => 'ロシア',
        'china' => '中国',
        'zaf' => '南アフリカ共和国',
        'twn' => '台湾',
        'emergent_countries' => '新興諸国',
        'jpn' => '日本',
        'kor' => '韓国',
        'hkg' => '香港',
        'all' => 'All',
    ];

  /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tweetEtfDifference {type}';

    /**
     * @var string
     */
    protected $description = '7日前との差分が一番大きなETFの tweet';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->getType();

        if ($this->isHoliday(Carbon::yesterday()) || empty($type)) {
          return;
        }

        $dataToday = $this->loadCsv(now(), $type);
        if(empty($dataToday)) {
          return;
        }

        $data7dayAgo = $this->loadCsv(now()->modify('-1 weeks'), $type);
        $maxedStock = $this->maxedStack($dataToday, $data7dayAgo);
        if('' === $maxedStock['code']) {
          return;
        }

        $message = $this->buildMessage(
            $dataToday[$maxedStock['code']],
            $maxedStock['differenc'],
            $type
        );
        $this->tweet($message);
    }

    protected function tweet($tweetMessage) {
        $apiKey = getenv('TWITTER_API_KEY');
        $apiSecret = getenv('TWITTER_API_SECRET');
        $accessToken  = getenv('TWITTER_ACCESS_TOKEN');
        $accessTokenSecret = getenv('TWITTER_ACCESS_TOKEN_SECRET');

        $connection = new TwitterOAuth($apiKey, $apiSecret, $accessToken, $accessTokenSecret);
        $connection->setApiVersion("2");
        $connection->post("tweets", ["text" => $tweetMessage], true);
    }

    protected function buildMessage($dataToday, $differenc, $type)
    {
        $message = '';
        if('' !== $type) {
            $message = '🤖 昨日の #ETF 投資地域 が「 '.$type.' 」で1週間で一番値上がりした商品だよ'.PHP_EOL.PHP_EOL;
        } else {
            $message = '🤖 昨日の #ETF の商品で1週間で一番値上がりした商品だよ'.PHP_EOL.PHP_EOL;
        }
        $message = $message.' #'.$dataToday[22].' で1週間比は'.$differenc.'%らしいよ'.PHP_EOL.PHP_EOL;

        if ($differenc < 0) {
            $message = $message.'え？一番よくてマイナスなの？'.PHP_EOL.PHP_EOL;
        } else if(10 < $differenc){
            $message = $message.'え？10%以上値上がりって...買っておけばよかった'.PHP_EOL.PHP_EOL;
        }
        $afterMessage = '今の #評価額 は'.number_format($dataToday[20]).'('.$dataToday[18].')で #分配金利回り は'.$dataToday[19].'%なんだって';

        return $message.PHP_EOL.$afterMessage.PHP_EOL.PHP_EOL.'';
    }

    protected function getType() {
      $optionType = $this->argument('type');

      if (empty($optionType)) {
          return null;
      } else {
          return self::TYPE[$optionType];
      }
    }

    protected function loadCsv($date, $type) {
        $row = 1;
        $path =  base_path('storage/app/public/rakuten_etf/'.$date->year.'/'.$date->month.'/'.$date->format('Ymd').'.csv');
        $csvData = [];

        if (($handle = fopen($path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if(count($data) < 8 || $data[1] === '' || $data[2] === '' || $data[1] === '1626' || $data[7] !== $type || empty($data[20])) {
                  continue;
                }
                $csvData[$data[0]] = $data;
            }
            fclose($handle);
        }

        return $csvData;
    }

    protected function isHoliday($date)
    {
        if (in_array((string)$date->dayOfWeek, ['0', '6'])) {
          return true;
        }

        $holidays = Yasumi::create('Japan', $date->year);
        return $holidays->isHoliday($date);
    }

    private function maxedStack($dataTodays, $data7dayAgos)
    {
      $code = '';
      $differenc = '-100';
      foreach ($dataTodays as $indexCode => $data) {

          if (!array_key_exists($indexCode, $data7dayAgos)) { continue; }

          $data7dayAgo = $data7dayAgos[$indexCode];
          if(empty($data7dayAgo) || empty($data[0])) { continue; }

          $tmpDifferenc = round($data[20] / $data7dayAgo[20] - 1, 5) * 100;
          if ($differenc <= $tmpDifferenc) {
            $code = $indexCode;
            $differenc = $tmpDifferenc;
          }
      }

      return ['code' => $code, 'differenc' => $differenc];
    }
}
