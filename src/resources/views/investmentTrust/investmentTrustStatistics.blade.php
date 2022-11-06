<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="keywords" content="投資,投資信託,投信,グラフ,コモディティ,国際REIT,国際株式,国際債券,国内REIT,国内株式,国内債券,バランス,ブル・ベア,ヘッジファンド,その他,一覧,検索,ランキング">
        <title>投資信託分類別</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="/css/investmentTrustStatistics.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <script src="/js/investmentTrustStatistics.js"></script>
        <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title m-b-md">
                    <span class="title-str" id="title">投資信託一覧</span>
                </div>
                <div>
                    <div class="row" id='table-area'>
                        <div class='button-area' id='button-area'>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=commodity" id="commodity_button">コモディティ</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=world_reit" id="world_reit_button">国際REIT</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=world_stock" id="world_stock_button">国際株式</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=world_bond" id="world_bond_button">国際債券</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=jp_reit" id="jp_reit_button">国内REIT</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=jp_stock" id="jp_stock_button">国内株式</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=jp_bond" id="jp_bond_button">国内債券</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=balance" id="balance_button">バランス</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=bull_bear" id="bull_bear_button">ブル・ベア</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=hedge_fund" id="hedge_fund_button">ヘッジファンド</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=etc" id="etc_button">その他</a>
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
                        <div class='table'>
                            <table id='data-table'>
                                <thead>
                                    <tr>
                                        <th>協会コード</th>
                                        <th>ファンド名</th>
                                        <th>基準価額(円)</th>
                                        <th>前日比(円)</th>
                                        <th>前日比率(%)</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table-body"></tbody>
                            </table>
                        </div>
                        <a class="waves-effect waves-light btn submit" href="/investment_trust">
                            <i class="material-icons left">arrow_back</i> Back
                        </a>
                    </div>
                    <div class="row" id='loading'>
                        <div>データ読み込み中</div>
                        <div class="preloader-wrapper small active">
                            <div class="spinner-layer spinner-blue-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div><div class="gap-patch">
                                    <div class="circle"></div>
                                </div><div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="page-footer footer-copyright footer-color">
            <div class="container">
                © 2022 <a class = "fotter-link" href="https://unscrupulous-business-firm.com/%E8%AA%B0%E3%81%A0%E3%81%8A%E5%89%8D%E3%81%AF/" target="_blank">
                    悪徳商会
                </a>
            </div>
        </footer>
    </body>
</html>
