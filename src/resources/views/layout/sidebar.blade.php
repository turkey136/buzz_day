@section('sidebar')
    <ul id="slide-out" class="sidenav">
        <li><a href="/"><i class="material-icons menu-icon-color">home</i>ホーム</a></li>
        <li><a href="/buzz_top"><i class="material-icons menu-icon-color">video_library</i>動画</a></li>
        <ul class="sub-menu-list">
            <li><a href='/buzz_tube'><i class="material-icons menu-icon-color">local_movies</i>Youtube</a></li>
            <li><a href='/buzz_nico'><i class="material-icons menu-icon-color">local_movies</i>ニコニコ動画</a></li>
        </ul>
        <li><a href="/investment_trust"><i class="material-icons menu-icon-color">local_atm</i>投資信託</a></li>
        <ul class="sub-menu-list">
            <li>
              <a href='/investment_trust_statistics?kind_type=commodity'>
                  <i class="material-icons menu-icon-color">view_list</i>
                  分類別一覧
              </a>
            </li>
            <li>
                <a href='/investment_trust_statistics_graph?kind_type=commodity'>
                    <i class="material-icons menu-icon-color">show_chart</i>
                    分類別前日差グラフ
                </a>
            </li>
        </ul>
        <li><a href="/etf"><i class="material-icons menu-icon-color">local_atm</i>ETF</a></li>
    </ul>
    <div class='page-title-navi'>
        <a href="#" data-target="slide-out" class="sidenav-trigger navi-menu">
            <i class="material-icons menu-icon menu-icon-color">menu</i>
        </a>
        <p class='page-title'>
            @yield('pageTitle')
        </p>
    </div>
@endsection
