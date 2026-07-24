@extends('layouts.master')

@section('title', 'Our Products - Possible Electrofeb LLP')
@section('meta_description', 'Explore our comprehensive range of high-performance electrical panels including LT PCC, LT MCC, APFC, Meter Panels, Solar ACDB/DCDB, and Cable Tray Systems.')
@section('meta_keywords', 'LT AC Combiner Panels, LT PCC Panels, LT MCC Panel, APFC Panel, Meter Panel, Solar ACDB DCDB Panel, Cable Tray System')

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
        <!-- ./ page-header -->

        <section class="service-inner pt-130 pb-130">
            <div class="container container-2">
                <div class="row gy-5">
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => 'lt-ac-combiner-panels']) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                <img src="{{ asset('assets/img/service/service-img-1.png') }}" alt="LT AC COMBINER PANELS">
                                <span class="number">01</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">LT AC COMBINER PANELS</h5>
                                <p>High-capacity LT AC combiner boxes designed for robust power integration and solar generation.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => 'lt-pcc-panels']) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                <img src="{{ asset('assets/img/service/service-img-2.png') }}" alt="LT PCC PANELS">
                                <span class="number">02</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">LT PCC PANELS</h5>
                                <p>Heavy-duty Power Control Center panels for centralized power distribution and maximum safety.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => 'lt-mcc-panel']) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                <img src="{{ asset('assets/img/service/service-img-3.png') }}" alt="LT MCC PANEL">
                                <span class="number">03</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">LT MCC PANEL</h5>
                                <p>Advanced Motor Control Center panels for reliable motor protection and automated industrial operations.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => 'apfc-panel']) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                <img src="{{ asset('assets/img/service/service-img-4.png') }}" alt="APFC PANEL">
                                <span class="number">04</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">APFC PANEL</h5>
                                <p>Automatic Power Factor Correction panels engineered to optimize energy efficiency and cut utility costs.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => 'meter-panel']) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                <img src="{{ asset('assets/img/service/service-img-5.png') }}" alt="METER PANEL">
                                <span class="number">05</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">METER PANEL</h5>
                                <p>Precision electrical meter panels for centralized industrial and commercial power monitoring.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => 'solar-acdb-dcdb-panel']) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                <img src="{{ asset('assets/img/service/service-img-6.png') }}" alt="SOLAR ACDB / DCDB PANEL">
                                <span class="number">06</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">SOLAR ACDB / DCDB PANEL</h5>
                                <p>Custom ACDB and DCDB distribution boxes tailored for solar power installations and isolation.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => 'cable-tray-system']) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                <img src="{{ asset('assets/img/service/service-img-1.png') }}" alt="CABLE TRAY SYSTEM">
                                <span class="number">07</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">CABLE TRAY SYSTEM</h5>
                                <p>Industrial-grade perforated and ladder cable tray systems for organized cable management.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ service-inner -->
@endsection
