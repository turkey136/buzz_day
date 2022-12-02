@extends('layout.common')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="/css/investmentTrust.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="/js/investmentTrust.js"></script>
    <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
@endsection

@section('keywords', '投資,投資信託,投信,グラフ,コモディティ,国際REIT,国際株式,国際債券,国内REIT,国内株式,国内債券,バランス,ブル・ベア,ヘッジファンド,その他,一覧,検索,ランキング')
@section('description', '投資信託の一覧')
@section('title', '悪徳商会の工具箱:投資信託一覧')
@section('pageTitle', '投資信託一覧')

@section('content')
    <div class="row" id='table-area'>
        <div class='button-area' id='button-area'>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=commodity">コモディティ</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=world_reit">国際REIT</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=world_stock">国際株式</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=world_bond">国際債券</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=jp_reit">国内REIT</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=jp_stock">国内株式</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=jp_bond">国内債券</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=balance">バランス</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=bull_bear">ブル・ベア</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=hedge_fund">ヘッジファンド</a>
            <a class="waves-effect waves-light btn submit col s4 m2" href="/investment_trust_statistics?kind_type=etc">その他</a>
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
          <a class="waves-effect waves-light btn submit" id="submit">同意する</a>
        </div>
    </div>
    <div class="row" id='loading'>
        <div>データ読み込み中</div>
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-black-only">
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
@endsection

@include('layout.sidebar')
