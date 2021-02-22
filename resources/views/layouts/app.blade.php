<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ ($website['title']) ? $website['title'] : config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ ($website['description']) ? $website['description'] : config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ ($website['title']) ? $website['title'] : config('app.name', 'Laravel') }}" />
    <meta property="og:description" content="{{ ($website['description']) ? $website['description'] : config('app.name', 'Laravel') }}" />
    <meta name="description" content="{{ ($website['description']) ? $website['description'] : config('app.name', 'Laravel') }}" />
    <meta property="og:url" content="{{  ($website['url']) ? $website['url'] : url('') }}" />
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:image" content="{{  ($website['thumbnail']) ? $website['thumbnail'] : '' }}" />
    <meta property="og:locale" content="vi" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@CPM.Net.Vn" />
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Source+Sans+Pro:600,700" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"
	      href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
	      crossorigin="anonymous"/>
	<link rel="stylesheet" href="{{ asset('assets/css/style.css')  }}"/>
    @yield('css')
    <script type="application/ld+json">
    {
        "@context":"https://schema.org",
        "@graph":[
            {
                "@type":"WebPage",
                "@id":"{{  ($website['url']) ?  $website['url'] : url('') }}",
                "url":"{{  ($website['url']) ?  $website['url'] : url('') }}",
                "inLanguage":"vi",
                "name":"{{ ($website['title']) ? $website['title'] : config('app.name', 'Laravel') }}",
                "description":"{{ ($website['description']) ? $website['description'] : config('app.name', 'Laravel') }}",
                "isPartOf":{
                    "@id":"{{  route('blog') }}"
                }
            }
        ]
    }
    </script>
</head>
<body class="ui-transparent-nav" data-fade_in="on-load">
<!-- Navbar Fixed + Default -->
<nav class="navbar navbar-fixed-top navbar-dark bg-dark">
    <div class="container">

        <!-- Navbar Logo -->
        <a class="ui-variable-logo navbar-brand" href="{{ url('') }}" title="{{ ($website['title']) ? $website['title'] : config('app.name', 'Laravel') }}">
            <!-- Default Logo -->
            <img class="logo-default" src="{{ asset('assets/imgs/logo-white.png') }}" alt="{{ ($website['title']) ? $website['title'] : config('app.name', 'Laravel') }}" data-uhd>
            <!-- Transparent Logo -->
            <img class="logo-transparent" src="{{ asset('assets/imgs/logo-white.png') }}" alt="{{ ($website['title']) ? $website['title'] : config('app.name', 'Laravel') }}" data-uhd>
        </a><!-- .navbar-brand -->

        <!-- Navbar Navigation -->
        <div class="ui-navigation navbar-right">
            <ul class="nav navbar-nav">
                <!-- Nav Item -->
                <li class="active"><a href="#">Home</a>
                </li>
                <!-- Nav Item -->
                <li>
                    <a href="#" data-scrollto="advantages">Ưu Điểm</a>
                </li>
                <!-- Nav Item -->
                <li>
                    <a href="#" data-scrollto="features">Tính Năng </a>
                </li>
                <!-- Nav Item -->
                <li>
                    <a href="#" data-scrollto="pricing">Bảng Giá</a>
                </li>
                <li>
                    <a href="/blogs" >Tin tức</a>
                </li>
            </ul><!--.navbar-nav -->
        </div><!--.ui-navigation -->

        <!-- Navbar Button -->
        <a href="https://themeforest.net/item/app-landing-page-html/20000720" class="btn btn-sm ui-gradient-peach">Download</a>

        <!-- Navbar Toggle -->
        <a href="#" class="ui-mobile-nav-toggle"></a>

    </div><!-- .container -->
</nav> <!-- nav -->

<main id="app">

        @yield('content')
        <!-- Subscribe Footer -->
        <footer class="ui-footer subscribe-footer">
            <!-- Footer Copyright -->
            <div class="footer-copyright bg-dark-gray">
                <div class="container">
                    <div class="row">
                        <!-- Copyright -->
                        <div class="col-6">
                            <p>
                                &copy; 2021 <a href="http://cpm.net.vn" target="_blank" title="cpm.net.vn">CPM</a>
                            </p>
                        </div>
                        <!-- Social Icons -->
                        <div class="col-6 text-right">
                            <a class="btn ui-gradient-blue btn-circle shadow-md">
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a class="btn ui-gradient-peach btn-circle shadow-md">
                                <span class="fa fa-instagram"></span>
                            </a>
                            <a class="btn ui-gradient-green btn-circle shadow-md">
                                <span class="fa fa-twitter"></span>
                            </a>
                            <a class="btn ui-gradient-purple btn-circle shadow-md">
                                <span class="fa fa-pinterest"></span>
                            </a>
                        </div>
                    </div>
                </div><!-- .container -->
            </div><!-- .footer-copyright -->
        </footer><!-- .ui-footer -->
    </main><!-- .main -->

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.2.1.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/theme.js')  }}"></script>
    @yield('js')
</body>
</html>
