<!-- header-area-start -->
<header class="header sticky-active">
    <div class="primary-header">
        <div class="container">
            <div class="primary-header-inner">
                <div class="header-left-wrap">
                    <div class="header-logo d-lg-block">
                        <a href="{{ route('home') }}">
                            <img src="{{ $setting?->logo ? asset('storage/'.$setting?->logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg') }}" alt="{{ $setting?->company_name ?? 'Possible Electrofeb' }} Logo" style="max-height: 48px; width: auto;">
                        </a>
                    </div>
                    @include('partials.navbar')
                </div>
                <div class="header-right-wrap">
                    <div class="header-btn-wrap">
                        <a href="{{ $setting?->company_profile_pdf ? asset('storage/'.$setting?->company_profile_pdf) : asset('assets/Document/POSSIBLE ELECTROFEB COMPANY PROFILE.pdf') }}" target="_blank" class="tl-primary-btn header-btn">Get Company Profile</a>
                    </div>
                    <button class="mobile-side-menu-toggle d-lg-none" aria-label="Toggle Navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="popup-search-box">
    <div class="box-inner-wrap d-flex align-items-center">
        <form id="form" action="#" method="get" role="search">
            <input id="popup-search" type="text" name="s" placeholder="Type keywords here...">
        </form>
        <div class="search-close"><i class="fa-sharp fa-regular fa-xmark"></i></div>
    </div>
</div>

<div id="sidebar-area" class="sidebar-area">
    <button class="sidebar-trigger close">
        <svg class="sidebar-close" xmlns="http://www.w3.org/2000/svg" width="16px" height="12.7px" viewBox="0 0 16 12.7">
            <g>
                <rect x="0" y="5.4" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.1569 7.5208)" width="16" height="2"></rect>
                <rect x="0" y="5.4" transform="matrix(0.7071 0.7071 -0.7071 0.7071 6.8431 -3.7929)" width="16" height="2"></rect>
            </g>
        </svg>
    </button>
    <div class="side-menu-content">
        <div class="side-menu-logo">
            <a class="dark-img" href="{{ route('home') }}"><img src="{{ $setting?->dark_logo ? asset('storage/'.$setting?->dark_logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg') }}" alt="logo" style="max-height: 48px; width: auto;"></a>
            <a class="light-img" href="{{ route('home') }}"><img src="{{ $setting?->logo ? asset('storage/'.$setting?->logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg') }}" alt="logo" style="max-height: 48px; width: auto;"></a>
        </div>
        <div class="side-menu-wrap"></div>
        <div class="side-menu-about">
            <h4 class="title">{{ $setting?->company_name ?? 'Possible Electrofeb LLP' }} - Leading Electrical & Engineering Solutions</h4>
        </div>
        <div class="side-menu-gallary">
            <div class="side-menu-gallary-item">
                <a href="{{ asset('assets/img/project/sidebar-gallary-1.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/sidebar-gallary-1.png') }}" alt="img"></a>
            </div>
            <div class="side-menu-gallary-item">
                <a href="{{ asset('assets/img/project/sidebar-gallary-2.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/sidebar-gallary-2.png') }}" alt="img"></a>
            </div>
            <div class="side-menu-gallary-item">
                <a href="{{ asset('assets/img/project/sidebar-gallary-3.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/sidebar-gallary-3.png') }}" alt="img"></a>
            </div>
            <div class="side-menu-gallary-item">
                <a href="{{ asset('assets/img/project/sidebar-gallary-4.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/sidebar-gallary-4.png') }}" alt="img"></a>
            </div>
            <div class="side-menu-gallary-item">
                <a href="{{ asset('assets/img/project/sidebar-gallary-5.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/sidebar-gallary-5.png') }}" alt="img"></a>
            </div>
            <div class="side-menu-gallary-item">
                <a href="{{ asset('assets/img/project/sidebar-gallary-6.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/sidebar-gallary-6.png') }}" alt="img"></a>
            </div>
        </div>
        <div class="side-menu-contact">
            <ul class="side-menu-list">
                <li>{{ $setting?->company_address ?? 'Plot No.04, Shital Ind. Area, Opp Jamwadi G.I, opp. Vraj Cold Storage, D.C, Jamwadi, Gondal, Gujarat 360311' }}</li>
                <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', $setting?->company_phone ?? '+918200268204') }}">{{ $setting?->company_phone ?? '+91 82002 68204' }}</a></li>
                <li><a class="mail" href="mailto:{{ $setting?->company_email ?? 'electrofeb@possiblegroups.com' }}">{{ $setting?->company_email ?? 'electrofeb@possiblegroups.com' }}</a></li>
            </ul>
        </div>
        <ul class="side-menu-social">
            <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li class="instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li class="g-plus"><a href="#"><i class="fab fa-fab fa-google-plus-g"></i></a></li>
        </ul>
    </div>
</div>
<div id="sidebar-overlay"></div>

<div class="mobile-side-menu">
    <div class="side-menu-content">
        <div class="side-menu-head">
            <a href="{{ route('home') }}"><img src="{{ $setting?->logo ? asset('storage/'.$setting?->logo) : asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg') }}" alt="logo" style="max-height: 42px; width: auto;"></a>
            <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
        </div>
        <div class="side-menu-wrap"></div>
    </div>
</div>
<div class="mobile-side-menu-overlay"></div>
