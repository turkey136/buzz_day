<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="keywords" content="投資,投資信託,投信,グラフ,コモディティ,国際REIT,国際株式,国際債券,国内REIT,国内株式,国内債券,バランス,ブル・ベア,ヘッジファンド,その他,チャート">
        <title>投資信託分類別</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/taucharts@2/dist/taucharts.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="/css/investmentTrustStatisticsGraph.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/d3@4.13.0/build/d3.min.js" charset="utf-8"></script>
        <script src="https://cdn.jsdelivr.net/npm/taucharts@2/dist/taucharts.min.js" type="text/javascript"></script>
        <script src="/js/investmentTrustStatisticsGraph.js"></script>
        <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title m-b-md">
                    <span class="title-str" id="title">投資信託</span>
                </div>
                <div class="row">
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
                        <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics_graph?kind_type=all" id="all_button">全て</a>
                    </div>
                    <div id='synchronized-date' class="synchronized-date"></div>
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
                <div class="row">
                    <div id="scatter"></div>
              </div>
                <div class="row">
                    <a class="waves-effect waves-light btn submit" id='back' href="/investment_trust_statistics">
                        <i class="material-icons left">arrow_back</i> Back
                    </a>
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
