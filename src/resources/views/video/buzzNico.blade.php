@extends('layout.common')

@section('head')
    <link rel="stylesheet" href="/css/buzzNico.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.css' rel='stylesheet'>
    <script src="/js/buzzNico.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.js'></script>
    <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
@endsection

@section('keywords', 'youtube,YouTube,急上昇,人気,ニコニコ,動画,ニコニコ動画,ランキング,1位')
@section('description', 'ニコニコ動画の昨日の24時間閲覧ランキング1位')
@section('title', '悪徳商会の工具箱:ニコニコ動画1位')
@section('pageTitle', 'ニコニコ動画の閲覧1位 Videos')

@section('content')
    <div id='calendar' class="calendar"></div>
@endsection

@include('layout.sidebar')
