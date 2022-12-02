<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="google-site-verification" content="4_W4djHFL0__hXHOD3MLqn6SnlaJQF7XMF5c03IgPGU" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="/js/app.js"></script>
        <title>@yield('title')</title>
        <meta name="description" itemprop="description" content="@yield('description')">
        <meta name="keywords" itemprop="keywords" content="@yield('keywords')">

        <link rel="stylesheet" href="/css/common_sidebar.css">
        <link rel="stylesheet" href="/css/common.css">
        @yield('head')
    </head>
    <header>
        @yield('header')
    </header>
    <body>
        <div class="sub">
            @yield('sidebar')
        </div>
        <div class="flex-center position-ref">
            <div class="content">
                @yield('content')
            </div>
        </div>

        <p class = "porn-link">
            <a href="/porn" target="_blank" class='porn-link'>
              ■
            </a>
        </p>
        <footer class="page-footer footer-copyright footer-color">
            <div class="container">
                <p>
                    © 2022 <a class = "fotter-link" href="https://unscrupulous-business-firm.com/%E8%AA%B0%E3%81%A0%E3%81%8A%E5%89%8D%E3%81%AF/" target="_blank">
                        悪徳商会
                    </a>
                  </p>
            </div>
        </footer>
    </body>
</html>
