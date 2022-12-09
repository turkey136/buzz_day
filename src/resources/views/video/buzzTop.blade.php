@extends('layout.common')

@section('head')
    <link rel="stylesheet" href="/css/buzzTop.css">
    <script src="/js/buzzTop.js"></script>
    <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
@endsection

@section('keywords', 'youtube,YouTube,急上昇,人気,ニコニコ,動画,ニコニコ動画,ランキング,1位')
@section('description', 'Youtube・ニコニコ動画の昨日の24時間閲覧ランキング1位')
@section('title', '悪徳商会の工具箱:動画Top')
@section('pageTitle', '昨日の閲覧1位 Videos')

@section('content')
    <div>
        <div class="row">
            <a href="/buzz_tube" class="vist-link">
              <div class="col s12 m6">
                  <div class="card">
                      <span class="card-title">
                          Youtube
                      </span>
                      <div class="card-image">
                          <div id='load_youtube' class="preloader-wrapper small active">
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
                          <img class="non-display" id="yesterday_youtube" src="">
                      </div>
                  </div>
              </div>
            </a>
            <a href="/buzz_nico" class="vist-link">
                <div class="col s12 m6">
                    <div class="card">
                        <span class="card-title">
                            ニコニコ動画
                        </span>
                        <div class="card-image">
                            <div id='load_niconico' class="preloader-wrapper small active">
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
                            <img class="non-display" id="yesterday_niconico" src="/#">
                        </div>
                      </div>
                  </div>
              </div>
          </a>
    </div>
@endsection

@include('layout.sidebar')
