<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="keywords" content="youtube,YouTube,急上昇,人気,ニコニコ,動画,ニコニコ動画,ランキング">
        <title>投資信託一覧</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="/css/investmentTrust.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <script src="/js/investmentTrust.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title m-b-md">
                    <span class="title-str">投資信託一覧</span>
                </div>
                <div>
                    <div class="row" id='table-area'>
                        <div class='button-area' id='button-area'>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=commodity">コモディティ</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=world_reit">国際REIT</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=world_stock">国際株式</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=world_bond">国際債券</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=jp_reit">国内REIT</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=jp_stock">国内株式</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=jp_bond">国内債券</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=balance">バランス</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=bull_bear">ブル・ベア</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=hedge_fund">ヘッジファンド</a>
                            <a class="waves-effect waves-light btn submit" href="/investment_trust_statistics?kind_type=etc">その他</a>
                        </div>
                        <div id='synchronized-date' class="synchronized-date"></div>
                        <div class='table'>
                            <table id='data-table'>
                                <thead>
                                    <tr>
                                        <th>協会コード</th>
                                        <th>ファンド名</th>
                                        <th>積立対象</th>
                                        <th>NISA対象</th>
                                        <th>つみたてNISA対象</th>
                                        <th>インデックス</th>
                                        <th>基準価額(円)</th>
                                        <th>前日比(円)</th>
                                        <th>前日比率(%)</th>
                                        <th>信託報酬(%)</th>
                                        <th>年間概算信託報酬(円)</th>
                                        <th>年間分配金(円)</th>
                                        <th>分配金利回り(%)</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table-body"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id='disclaimer'>
                        <div class="disclaimer">免責事項</div>
                        本サイトで表示している評価額、分配金、信託報酬等は個人で収集したものであり実際の値と差異がある可能性があります。<br>
                        お使いの証券会社の情報を確認してください。<br>
                        以上を認識し、使用してください。同意後に投資信託情報を表示します。
                        <div class="disclaimer-button">
                          <a class="waves-effect waves-light btn cancel" href="/">同意しない</a>
                          <a class="waves-effect waves-light btn submit" id="submit">同意する</a>
                        </div>
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
                        <a class="waves-effect waves-light btn submit" href="/">
                            <i class="material-icons left">arrow_back</i> Back
                        </a>
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
