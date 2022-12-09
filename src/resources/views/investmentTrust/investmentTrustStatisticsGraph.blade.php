@extends('layout.common')

@section('head')
    <link rel="stylesheet" href="/css/investmentTrustStatisticsGraph.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="/js/investmentTrustStatisticsGraph.js"></script>
    <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
@endsection

@section('keywords', '投資,投資信託,投信,グラフ,コモディティ,国際REIT,国際株式,国際債券,国内REIT,国内株式,国内債券,バランス,ブル・ベア,ヘッジファンド,その他,一覧,検索,チャート')
@section('description', '投資信託の前日差グラフ')
@section('title', '悪徳商会の工具箱:分類別投資信託の前日差グラフ')
@section('pageTitle', '分類別投資信託グラフ')

@section('content')
    <div class='row button-area' id='button-area'>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=commodity" id="commodity_button">コモディティ</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=world_reit" id="world_reit_button">国際REIT</a>
        <a class="waves-effect waves-light btn submit  col s4 m2" href="/investment_trust_statistics?kind_type=world_stock" id="world_stock_button">国際株式</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=world_bond" id="world_bond_button">国際債券</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=jp_reit" id="jp_reit_button">国内REIT</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=jp_stock" id="jp_stock_button">国内株式</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=jp_bond" id="jp_bond_button">国内債券</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=balance" id="balance_button">バランス</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=bull_bear" id="bull_bear_button">ブル・ベア</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=hedge_fund" id="hedge_fund_button">ヘッジファンド</a>
        <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=etc" id="etc_button">その他</a>
    </div>
    <div id='synchronized-date' class="synchronized-date"></div>
    <div class="avg-table-area">
        <table class="avg-table">
          <thead>
                <tr>
                    <th>分類平均基準額(円)</th>
                    <th>分類平均前日比(円)</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                <td id="avg_value"></td>
                <td id="avg_differenc"></td>
              </tr>
          </tbody>
        </table>
    </div>

    <div class="row" id='loading'>
        <div>データ読み込み中</div>
        <div class="preloader-wrapper small active">
        <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
  <div class="row">
      <div id="container"></div>
</div>
@endsection

@include('layout.sidebar')
