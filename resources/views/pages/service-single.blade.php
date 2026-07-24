@extends('layouts.master')

@section('title', 'Service Details - Antra Architecture & Interior Design')
@section('meta_description', 'Detailed overview of our specialized interior design and architectural planning services.')
@section('meta_keywords', 'service details, space optimization, flexible layouts, interior design')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Service Details</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("services") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("service.single") }}'> Service Details</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="service-details pt-130 pb-130">
            <div class="container container-2">
                <div class="row pin-inner">
                    <div class="col-lg-4 col-md-12">
                        <div class="service-details-left-content pin-box">
                            <div class="service-category-list">
                                <h3 class="list-title">Other Services</h3>
                                <ul>
                                    <li class="active"><a href="{{ route('service.single') }}">Residential Interior Design</a></li>
                                    <li><a href="{{ route('service.single') }}">Commercial Interior Design</a></li>
                                    <li><a href="{{ route('service.single') }}">Interior Design Consultation</a></li>
                                    <li><a href="{{ route('service.single') }}">Outdoor & Landscape Design</a></li>
                                    <li><a href="{{ route('service.single') }}">Renovation and Remodeling</a></li>
                                </ul>
                            </div>
                            <div class="service-details-cta">
                                <div class="cta-bg" data-background="{{ asset('assets/img/bg-img/service-cta-bg-2.png') }}"></div>
                                <div class="icon"><img src="{{ asset('assets/img/icon/service-details-cta.png') }}" alt="icon"></div>
                                <span>Do You Need Help?</span>
                                <a class="number" href="tel:+918200268204">+91 82002 68204</a>
                                <a class="mail" href="mailto:electrofeb@possiblegroups.com">electrofeb@possiblegroups.com</a>
                                <div class="cta-btn">
                                    <a href="{{ route('contact') }}">Get a call <br> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="service-details-content scroll-content">
                            <div class="service-details-img">
                                <img src="{{ asset('assets/img/service/service-details-img-1.png') }}" alt="img">
                            </div>
                            <h1 class="details-title">About the service</h1>
                            <p>Commercial interior design is constantly evolving, with new trends emerging to meet the changing needs and preferences of businesses and their customers.</p>
                            <div class="service-details-items">
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('assets/img/icon/service-details-1.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Space Optimization</h3>
                                        <p>Through smart space optimization interior design.</p>
                                    </div>
                                </div>
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('assets/img/icon/service-details-2.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Flexible Layouts</h3>
                                        <p>Custom adaptable layouts that fit your lifestyle.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="service-details-img-wrap">
                                <div class="details-img">
                                    <img src="{{ asset('assets/img/service/service-details-img-2.png') }}" alt="img">
                                </div>
                                <div class="details-img">
                                    <img src="{{ asset('assets/img/service/service-details-img-3.png') }}" alt="img">
                                </div>
                            </div>
                            <h2 class="details-title">Key Elements of Interior Design</h2>
                            <p>Key elements include space planning, lighting design, material selection, furniture and fixtures, color and texture, technology integration, and acoustics.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
