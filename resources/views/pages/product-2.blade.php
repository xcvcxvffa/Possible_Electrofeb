@extends('layouts.master')

@section('title', 'Product Style 2 - Possible Electrofeb LLP')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Products</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("products") }}'> Products</a></h4>
                </div>
            </div>
        </section>

        <section class="service-inner pt-130 pb-130">
            <div class="container container-2">
                <div class="row gy-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('product.single') }}"><img src="{{ asset('assets/img/service/service-img-1.png') }}" alt="LT AC COMBINER PANELS"></a>
                                <span class="number">01</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single') }}">LT AC COMBINER PANELS</a></h5>
                                <p>High-capacity LT AC combiner boxes designed for robust power integration and solar generation.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('product.single') }}"><img src="{{ asset('assets/img/service/service-img-2.png') }}" alt="LT PCC PANELS"></a>
                                <span class="number">02</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single') }}">LT PCC PANELS</a></h5>
                                <p>Heavy-duty Power Control Center panels for centralized power distribution and maximum safety.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('product.single') }}"><img src="{{ asset('assets/img/service/service-img-3.png') }}" alt="LT MCC PANEL"></a>
                                <span class="number">03</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single') }}">LT MCC PANEL</a></h5>
                                <p>Advanced Motor Control Center panels for reliable motor protection and automated industrial operations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('product.single') }}"><img src="{{ asset('assets/img/service/service-img-4.png') }}" alt="APFC PANEL"></a>
                                <span class="number">04</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single') }}">APFC PANEL</a></h5>
                                <p>Automatic Power Factor Correction panels engineered to optimize energy efficiency and cut utility costs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('product.single') }}"><img src="{{ asset('assets/img/service/service-img-5.png') }}" alt="METER PANEL"></a>
                                <span class="number">05</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single') }}">METER PANEL</a></h5>
                                <p>Precision electrical meter panels for centralized industrial and commercial power monitoring.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('product.single') }}"><img src="{{ asset('assets/img/service/service-img-6.png') }}" alt="SOLAR ACDB / DCDB PANEL"></a>
                                <span class="number">06</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single') }}">SOLAR ACDB / DCDB PANEL</a></h5>
                                <p>Custom ACDB and DCDB distribution boxes tailored for solar power installations and isolation.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('product.single') }}"><img src="{{ asset('assets/img/service/service-img-1.png') }}" alt="CABLE TRAY SYSTEM"></a>
                                <span class="number">07</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single') }}">CABLE TRAY SYSTEM</a></h5>
                                <p>Industrial-grade perforated and ladder cable tray systems for organized cable management.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
