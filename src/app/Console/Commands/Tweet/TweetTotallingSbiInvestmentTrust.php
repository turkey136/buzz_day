<?php

namespace App\Console\Commands\Tweet;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Abraham\TwitterOAuth\TwitterOAuth;
use Yasumi\Yasumi;

class TweetTotallingSbiInvestmentTrust extends Command
{
    const TYPE = [
        "commodity" => "コモディティ",
        "etc" => "その他",
        "balance" => "バランス",
        "bull_bear" => "ブル・ベア",
        "hedge_fund" => "ヘッジファンド",
        "world_reit" => "国際REIT",
        "world_stock" => "国際株式",
        "world_bond" => "国際債券",
        "jp_reit" => "国内REIT",
        "jp_stock" => "国内株式",
        "jp_bond" => "国内債券",
    ];

  /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tweetTotallingSbiInvestmentTrust {type}';

    /**
     * @var string
     */
    protected $description = 'SBI 投資信託集計の tweet';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday();
        $type = $this->getType();

        if ($this->isHoliday($yesterday) || empty($type)) {
          return;
        }
        $yesterdayData = $this->loadYesterdayJson($yesterday);

        if (empty($yesterdayData)) {
          return;
        }

        $message = $this->buildMessage($yesterdayData[$type], $type);
        $this->tweet($message);
    }

    protected function tweet($tweetMessage) {
        $apiKey = getenv('TWITTER_API_KEY');
        $apiSecret = getenv('TWITTER_API_SECRET');
        $accessToken  = getenv('TWITTER_ACCESS_TOKEN');
        $accessTokenSecret = getenv('TWITTER_ACCESS_TOKEN_SECRET');

        $connection = new TwitterOAuth($apiKey, $apiSecret, $accessToken, $accessTokenSecret);
        $connection->setApiVersion("2");
        $result = $connection->post("tweets", ["text" => $tweetMessage], true);
    }

    protected function buildMessage($yesterdayData, $type)
    {
        $message = '🤖 昨日の #投資信託 「' .$type . '」分野の #評価額 だよ。' . PHP_EOL . PHP_EOL;
        $message = $message . '平均評価額=' . $yesterdayData['avg_price'] . '円, 平均前日差=' . $yesterdayData['avg_day_before_ratio'] .'円' . PHP_EOL . PHP_EOL . PHP_EOL;

        if (0 <= $yesterdayData['avg_day_before_ratio']) {
            $message = $message . 'やったね！あがったよ' . PHP_EOL . PHP_EOL;

            if ($yesterdayData['price_3day'] < $yesterdayData['avg_price']) {
                $message = $message . 'しかも3営業日平均より上がっているよ';
            } else {
                $message = $message . 'でも3営業日平均より下がっている';
            }
        } else {
            $message = $message . '残念。下がっちゃった。明日は頑張って上げようね' . PHP_EOL;

            if ($yesterdayData['price_3day'] < $yesterdayData['avg_price']) {
                 $message = $message . 'でも3営業日平均より上がっているよ';
            } else {
                $message = $message . 'しかも3営業日平均より下がっている';
            }
        }

        return $message . PHP_EOL . PHP_EOL . '過去3営業日平均評価額=' . $yesterdayData['price_3day'] . '円, 過去3営業日平均前日差=' . $yesterdayData['day_before_ratio_3day'] . '円';
    }

    protected function getType() {
      $optionType = $this->argument('type');

      if (empty($optionType)) {
          return null;
      } else {
          return self::TYPE[$optionType];
      }
    }

    protected function loadYesterdayJson($yesterday) {
        $json = file_get_contents('storage/app/public/totalling_sbi_investment_trust.json');
        $json = json_decode($json, true);

        return $json[$yesterday->format("Y-m-d")];
    }

    protected function isHoliday($date)
    {
        if (in_array((string)$date->dayOfWeek, ['0', '6'])) {
          return true;
        }

        $holidays = Yasumi::create('Japan', $date->year);
        return $holidays->isHoliday($date);
    }
}
