@extends('layout.common')

@section('head')
    <link rel="stylesheet" href="/css/top.css">
@endsection

@section('keywords', '動画,急上昇,人気,投資信託,ランキング,厳選,ETF,証券,評価額,分配金,Youtube,ニコニコ動画,にこにこ')
@section('description', 'Youtube,ニコニコ動画の急上昇動画の表示。投資信託、ETF の評価額')
@section('title', '悪徳商会の工具箱:Top')
@section('pageTitle', '悪徳商会の工具箱')

@section('content')
    <div>
        <div class="row">
            <div class="col s12 m4">

                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            人気動画
                        </span>
                        <i class="material-icons large">ondemand_video</i>
                            <p>動画のランキング</p>
                    </div>
                    <div class="card-action">
                        <a href="/buzz_top">View</a>
                    </div>
                </div>
              </div>

              <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            投信信託
                        </span>
                        <i class="material-icons large">local_atm</i>
                            <p>投資信託の評価額</p>
                    </div>
                    <div class="card-action">
                        <a href="/investment_trust" class='top-card-action-link'>View</a>
                    </div>
                </div>
              </div>

                <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            ETF
                        </span>
                        <i class="material-icons large">local_atm</i>
                            <p>ETFの評価額</p>
                    </div>
                    <div class="card-action top-card-action-link">
                        <a href="/etf">View</a>
                    </div>
                </div>
              </div>
              <!-- ローカルと本番で挙動が異なるので一旦閉じる

              <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            小説
                        </span>
                        <i class="material-icons large">create</i>
                            <p>小説ランキング</p>
                    </div>
                    <div class="card-action">
                        <a href="/novel">View</a>
                    </div>
                </div>
              </div>
              -->
        </div>
    </div>
@endsection

@include('layout.sidebar')
