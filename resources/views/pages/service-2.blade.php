@extends('layouts.master')

@section('title', 'Service Style 2 - Antra')

@section('content')
<div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Services</h1>
                    <h4 class="sub-title"><a class='home' href='service.html'>Home </a><span class="icon">-</span><a class='inner-page' href='service-2.html'> Services</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="service-inner pt-130 pb-130">
            <div class="container container-2">
                <div class="row service-inner-item-wrap gy-5" data-masonry='{"percentPosition": true }'>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-2 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('service.single') }}"><img src="{{ asset('assets/img/service/service-img-1.png') }}" alt="service"></a>
                                <span class="number">01</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('service.single') }}">Residential Interior Design</a></h5>
                                <p>Tailored design services for private homes, including room makeovers and complete home transformations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-2 antra-hover-view big">
                            <div class="service-thumb">
                                <a href="{{ route('service.single') }}"><img src="{{ asset('assets/img/service/service-img-2.png') }}" alt="service"></a>
                                <span class="number">02</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('service.single') }}">Renovation and Remodeling</a></h5>
                                <p>Tailored design services for private homes, including room makeovers and complete home transformations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-2 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('service.single') }}"><img src="{{ asset('assets/img/service/service-img-3.png') }}" alt="service"></a>
                                <span class="number">03</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('service.single') }}">Commercial Interior Design</a></h5>
                                <p>Tailored design services for private homes, including room makeovers and complete home transformations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-2 antra-hover-view big">
                            <div class="service-thumb">
                                <a href="{{ route('service.single') }}"><img src="{{ asset('assets/img/service/service-img-4.png') }}" alt="service"></a>
                                <span class="number">04</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('service.single') }}">Interior Design Consultation</a></h5>
                                <p>Tailored design services for private homes, including room makeovers and complete home transformations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-2 antra-hover-view">
                            <div class="service-thumb">
                                <a href="{{ route('service.single') }}"><img src="{{ asset('assets/img/service/service-img-5.png') }}" alt="service"></a>
                                <span class="number">05</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('service.single') }}">Outdoor & Landscape Design</a></h5>
                                <p>Tailored design services for private homes, including room makeovers and complete home transformations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-2 antra-hover-view big">
                            <div class="service-thumb">
                                <a href="{{ route('service.single') }}"><img src="{{ asset('assets/img/service/service-img-6.png') }}" alt="service"></a>
                                <span class="number">06</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('service.single') }}">Renovation and Remodeling</a></h5>
                                <p>Tailored design services for private homes, including room makeovers and complete home transformations.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="newsletter-section bg-white pt-130 pb-130 overflow-hidden">
            <div class="bg-shape"><img src="{{ asset('assets/img/shapes/newsletter-shape.png') }}" alt="shape"></div>
            <div class="container">
                <div class="newsletter-wrap">
                    <div class="section-heading text-center">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Subscribe to the newsletter</h4>
                        <h2 class="section-title">Join <span>our newsletter <br> stay</span> up to date</h2>
                        <p>Join our newsletter. Learn something new, gain access to exclusive content, <br> and stay informed with the latest updates in the industry.</p>
                    </div>
                    <div class="newsletter-form">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email address..">
                        <button type="submit"><i class="fa-regular fa-arrow-right-long"></i></button>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ newsletter-section -->
@endsection

