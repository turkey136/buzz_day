@extends('layout.common')

@section('head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.js'></script>
    <script src="/js/buzzTube.js"></script>
    <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{getenv('ADSENSE_CLIENT')}}" crossorigin="anonymous"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.0/main.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/buzzTube.css">
@endsection

@section('keywords', 'youtube,YouTube,急上昇,人気,ランキング,1位')
@section('description', 'Youtube毎日の24時間閲覧ランキング1位')
@section('title', '悪徳商会の工具箱:Youtube 1位')
@section('pageTitle', 'Youtube 閲覧1位 Videos')

@section('content')
    <div id='calendar' class="calendar"></div>
@endsection

@include('layout.sidebar')
