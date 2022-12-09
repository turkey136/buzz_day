@extends('layout.common')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="/css/etfTop.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="/js/etfTop.js"></script>
    <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
@endsection

@section('keywords', '投資,ETF,海外株式,海外ETF,一覧,検索,ランキング')
@section('description', '海外ETFの一覧')
@section('title', '悪徳商会の工具箱:海外ETF一覧')
@section('pageTitle', '海外一覧')

@section('content')
    <div class="row" id='table-area'>
        <div id='synchronized-date' class="synchronized-date"></div>
        <div class='table'>
            <table id='data-table'>
                <thead>
                    <tr>
                        <th>コード</th>
                        <th>市場</th>
                        <th>銘柄名</th>
                        <th>基準価格</th>
                        <th>分配金利回り(%)</th>
                        <th>経費率(%)</th>
                        <th>投資地域</th>
                    </tr>
                </thead>
                <tbody id="data-table-body"></tbody>
            </table>
        </div>
    </div>
    <div class="row" id='disclaimer'>
        <div class="disclaimer">免責事項</div>
        本サイトで表示している評価額、分配金利回り等は個人で収集したものであり実際の値と差異がある可能性があります。<br>
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
