@extends('layout.common')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
    <link rel="stylesheet" href="/css/goldTop.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="/js/goldTop.js"></script>
    <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
@endsection

@section('keywords', '投資,金,銀,プラチナ,一覧,検索,ランキング,Exchange Traded Funds,上場投信')
@section('description', '金銀の売値一覧')
@section('title', '悪徳商会の工具箱:金銀売値一覧')
@section('pageTitle', '金銀売値一覧')

@section('content')
    <div class="row" id='table-area'>
        <div id='synchronized-date' class="synchronized-date"></div>
        <div class='table'>
            <table id='data-table'>
                <thead>
                    <tr>
                        <th>日付け</th>
                        <th>金(円/g)</th>
                        <th>銀(円/g)</th>
                        <th>プラチナ(円/g)</th>
                    </tr>
                </thead>
                <tbody id="data-table-body"></tbody>
            </table>
        </div>
    </div>
    <div class="row" id='disclaimer'>
        <div class="disclaimer">免責事項</div>
        本サイトで表示している価格は個人で収集したものであり実際の値と差異がある可能性があります。<br>
        お使いの証券会社の情報を確認してください。<br>
        以上を認識し、使用してください。同意後に情報を表示します。
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
@endsection

@include('layout.sidebar')
