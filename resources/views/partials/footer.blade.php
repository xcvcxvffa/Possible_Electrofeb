<style>
    .footer-social-icons li:before, 
    .footer-social-icons li:after,
    .footer-widget .footer-social-icons li:before,
    .footer-widget .footer-social-icons li:after {
        display: none !important;
        content: "" !important;
    }
    
    .footer-social-link {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
        background-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
    }

    .footer-social-link:hover {
        background-color: #0097A0 !important;
        border-color: #0097A0 !important;
        color: #ffffff !important;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 151, 160, 0.4);
    }
</style>
<footer class="footer-section overflow-hidden">
    <div class="footer-bg" data-background="{{ asset('assets/img/images/Footer_bg_image.webp') }}"></div>
    <div class="footer-shade"></div>
    <div class="container container-2">
        <div class="row footer-wrap">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/POSSIBLE ELECTROFEB LOGO.svg') }}" alt="Possible Electrofeb Logo" style="max-height: 48px; width: auto;"></a>
                        </div>
                    </div>
                    <p class="mb-0" style="color: rgba(255, 255, 255, 0.7); font-size: 14px; line-height: 1.7;">High-performance electrical panels, LT PCC, LT MCC, APFC, and custom industrial distribution solutions.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget footer-col-2">
                    <ul class="footer-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="{{ route('blogs') }}">Blog</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget footer-col-2 pl-0">
                    <ul class="footer-list">
                        <li><a href="{{ route('product.single', ['slug' => 'lt-pcc-panels']) }}">LT PCC PANELS</a></li>
                        <li><a href="{{ route('product.single', ['slug' => 'lt-ac-combiner-panels']) }}">LT AC COMBINER PANELS</a></li>
                        <li><a href="{{ route('product.single', ['slug' => 'lt-mcc-panel']) }}">LT MCC PANEL</a></li>
                        <li><a href="{{ route('product.single', ['slug' => 'apfc-panel']) }}">APFC PANEL</a></li>
                        <li><a href="{{ route('product.single', ['slug' => 'meter-panel']) }}">METER PANEL</a></li>
                        <li><a href="{{ route('product.single', ['slug' => 'solar-acdb-dcdb-panel']) }}">SOLAR ACDB / DCDB PANEL</a></li>
                        <li><a href="{{ route('product.single', ['slug' => 'cable-tray-system']) }}">CABLE TRAY SYSTEM</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget">
                    <div class="footer-address">
                        <a class="number d-block mb-1" href="tel:+918200268204" style="font-weight: 600; font-size: 20px;">+91 82002 68204</a>
                        <a class="mail d-block mb-3" href="mailto:electrofeb@possiblegroups.com" style="font-size: 20px; white-space: nowrap; word-break: normal;">electrofeb@possiblegroups.com</a>
                        
                        <p class="address mb-3" style="color: rgba(255, 255, 255, 0.7); font-size: 14px; line-height: 1.6;">
                            Plot No.04, Shital Ind. Area, Opp Jamwadi G.I, opp. Vraj Cold Storage, D.C, Jamwadi, Gondal, Gujarat 360311
                        </p>

                        <ul class="footer-social-icons list-unstyled d-flex align-items-center gap-2 mt-3 mb-0">
                            <li><a href="#" aria-label="Facebook" class="footer-social-link"><i class="fab fa-facebook-f fs-6"></i></a></li>
                            <li><a href="#" aria-label="Instagram" class="footer-social-link"><i class="fab fa-instagram fs-6"></i></a></li>
                            <li><a href="#" aria-label="YouTube" class="footer-social-link"><i class="fab fa-youtube fs-6"></i></a></li>
                            <li><a href="#" aria-label="LinkedIn" class="footer-social-link"><i class="fab fa-linkedin-in fs-6"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-content">
                <p>© {{ date('Y') }} Possible Electrofeb LLP. All Rights Reserved.</p>
            </div>
        </div>
    </div>
    <div class="footer-text"><span>Possible </span></div>
</footer>
