<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    @include('partials.head')
</head>
<body>
    <!-- preloader -->
    <div class="preloader overflow-hidden">
        <div class="site-name"><span>POSSIBLE ELECTROFEB</span></div>
        <div class="preloader-gutters">
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
        </div>
    </div>
    <!-- /.preloader -->

    @include('partials.header')

    <div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">
            <main>
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>

    <div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>

    @include('partials.scripts')
</body>
</html>
