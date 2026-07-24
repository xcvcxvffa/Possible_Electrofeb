<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="@yield('meta_description', 'Possible Electrofeb LLP - Leading Electrical & Engineering Solutions')">
<meta name="keywords" content="@yield('meta_keywords', 'electrical, electrofeb, engineering, possible electrofeb, cables, wiring, industrial solutions')">

<!-- OpenGraph Meta Tags -->
<meta property="og:title" content="@yield('title', 'Possible Electrofeb LLP')">
<meta property="og:description" content="@yield('meta_description', 'Possible Electrofeb LLP - Leading Electrical & Engineering Solutions')">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('assets/img/logo/logo-1.png') }}">

<!-- Site Title -->
<title>@yield('title', 'Possible Electrofeb LLP')</title>

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

<!-- CSS Here -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/venobox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/odometer.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/carouselTicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animation.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/twentytwenty.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
@stack('styles')
