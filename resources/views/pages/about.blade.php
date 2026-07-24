@extends('layouts.master')

@section('title', 'About Possible Electrofeb LLP - Leading Electrical Panel Solutions')
@section('meta_description', 'POSSIBLE ELECTROFEB LLP is dedicated to delivering reliable and efficient electrical panel solutions for industrial, commercial, infrastructure and renewable energy applications.')
@section('meta_keywords', 'About Possible Electrofeb LLP, Electrical Panel Manufacturer, PCC Panels, MCC Panels, APFC Panels, India')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">About Us</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("about") }}'> About Us</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <!-- Company Introduction & About Company -->
        <section class="about-section-9 pt-130 pb-130 overflow-hidden fade-wrapper tl-bg-color">
            <div class="shape-1"><img src="{{ asset('assets/img/shapes/about-shape-8.png') }}" alt="shape"></div>
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top ml-0 mw-100">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">About Possible Electrofeb LLP</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Delivering <span>Reliable & Efficient</span> Electrical Panel Solutions</h2>
                        </div>
                    </div>
                </div>
                <div class="about-img-9 fade-top">
                    <img src="{{ asset('assets/img/images/Possible_About.webp') }}" alt="About Possible Electrofeb LLP">
                </div>
                <div class="about-content-9 fade-top">
                    <div class="about-counter">
                        <h3 class="title"><span class="odometer" data-count="22">0</span></h3>
                        <p>years of work <br>experience</p>
                    </div>
                    <div class="about-desc">
                        <p class="mb-3">POSSIBLE ELECTROFEB LLP is a trusted manufacturer of electrical panels and fabricated products, based in Gondal, Gujarat. With over two decades of hands-on experience, we specialize in delivering reliable power distribution and control solutions for industrial, commercial, infrastructure, and renewable energy sectors.</p>
                        <p class="mb-3">Our manufacturing facility is equipped with modern tools and machinery, enabling us to fabricate precision-built panels — from PCC and MCC to APFC and Solar ACDB/DCDB — that meet stringent performance, safety, and quality benchmarks.</p>
                        <p class="mb-0">We believe in building long-term relationships with our clients by offering customized engineering, timely delivery, and dependable after-sales support — ensuring their operations run safely and efficiently at every stage.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ about-section -->

        <!-- Mission & Vision -->
        <section class="feature-section pt-130 pb-130 overflow-hidden bg-white">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top ml-0 mw-100">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Mission & Vision</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Our Strategic <span>Purpose & Future</span> Outlook</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 pt-4">
                    <div class="col-lg-6 fade-top">
                        <div class="service-item-2 bg-grey p-5 rounded-4 h-100 shadow-sm" style="transition: all 0.4s ease; border-radius: 20px;">
                            <div class="service-thumb mb-4 overflow-hidden" style="height: 260px; border-radius: 16px;">
                                <img src="{{ asset('assets/img/images/exp-img-1.png') }}" alt="Our Mission" style="height: 100%; width: 100%; object-fit: cover; border-radius: 16px; transition: transform 0.4s ease;">
                            </div>
                            <div class="service-content">
                                <h3 class="title mb-3" style="font-size: 26px; font-weight: 500; color: #191919;">Our Mission</h3>
                                <p class="mb-0 text-secondary fs-6" style="line-height: 1.8;">Our mission is not only to manufacture electrical panels and fabricated products but also to become a dependable engineering partner for industries seeking quality, trust and technical expertise.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 fade-top">
                        <div class="service-item-2 bg-grey p-5 rounded-4 h-100 shadow-sm" style="transition: all 0.4s ease; border-radius: 20px;">
                            <div class="service-thumb mb-4 overflow-hidden" style="height: 260px; border-radius: 16px;">
                                <img src="{{ asset('assets/img/images/exp-img-2.png') }}" alt="Our Vision" style="height: 100%; width: 100%; object-fit: cover; border-radius: 16px; transition: transform 0.4s ease;">
                            </div>
                            <div class="service-content">
                                <h3 class="title mb-3" style="font-size: 26px; font-weight: 500; color: #191919;">Our Vision</h3>
                                <p class="mb-0 text-secondary fs-6" style="line-height: 1.8;">We aspire to become a complete engineering and manufacturing solutions provider for industrial electrical infrastructure and energy systems.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ Mission & Vision -->

        <!-- Core Values -->
        <section class="service-section pt-130 pb-130 bg-grey">
            <div class="container container-2">
                <div class="row section-heading-wrap ml-0 mw-100">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Our Core Values</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect">Principles <span>Guiding Our</span> Operations</h2>
                            <p class="mb-0">Every product we deliver is built on a foundation of precision engineering, strict quality standards, and an unwavering commitment to safety — ensuring long-term reliability for every client.</p>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 align-items-stretch">
                    <div class="col-xl-3 col-lg-6 col-md-12 d-flex">
                        <div class="service-item h-100 w-100 slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
                            <div class="service-top">
                                <h3 class="title">Quality</h3>
                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/service-icon-1.png') }}" alt="Quality">
                                </div>
                            </div>
                            <p>Every panel we manufacture undergoes rigorous testing and inspection to ensure it meets the highest standards of performance, durability, and electrical safety before leaving our facility.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 d-flex">
                        <div class="service-item h-100 w-100 slide-anim" data-delay="0.3" data-offset="100" data-direction="bottom">
                            <div class="service-top">
                                <h3 class="title">Safety</h3>
                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/service-icon-2.png') }}" alt="Safety">
                                </div>
                            </div>
                            <p>Safety is embedded into every step of our manufacturing process. From component selection to final assembly, we follow strict protocols to ensure each product operates securely under all industrial conditions.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 d-flex">
                        <div class="service-item h-100 w-100 slide-anim" data-delay="0.3" data-offset="100" data-direction="bottom">
                            <div class="service-top">
                                <h3 class="title">Innovation</h3>
                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/service-icon-3.png') }}" alt="Innovation">
                                </div>
                            </div>
                            <p>We continuously invest in advanced technologies, modern machinery, and updated engineering practices to stay ahead of industry demands and deliver smarter, more efficient electrical solutions.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 d-flex">
                        <div class="service-item h-100 w-100 slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <div class="service-top">
                                <h3 class="title">Service</h3>
                                <div class="icon">
                                    <img src="{{ asset('assets/img/icon/service-icon-4.png') }}" alt="Service">
                                </div>
                            </div>
                            <p>We are dedicated to providing responsive, end-to-end service — from initial consultation and design through manufacturing, delivery, installation support, and after-sales assistance — ensuring a smooth experience at every stage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ Core Values -->

        <!-- Industries We Serve (banner-process-area from Home-3) -->
        <section class="banner-process-area overflow-hidden">
            <div class="service-carousel-wrap">
                <div class="banner-process-carousel">
                    <div class="swiper-wrapper antra-swiper-wrapper">
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">01</span>
                                <h3 class="banner-process-title"><a href="{{ route('products') }}">Industrial <br> Manufacturing</a></h3>
                                <div class="banner-process-content">
                                    Tailored power distribution & control panels designed for heavy manufacturing plants and factories.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">02</span>
                                <h3 class="banner-process-title"><a href="{{ route('products') }}">Renewable <br> Energy</a></h3>
                                <div class="banner-process-content">
                                    High-capacity LT AC combiner boxes, ACDB & DCDB panels for solar energy installations.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">03</span>
                                <h3 class="banner-process-title"><a href="{{ route('products') }}">Commercial <br> Buildings</a></h3>
                                <div class="banner-process-content">
                                    Reliable power control centers & APFC panels for commercial complexes, malls, and towers.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">04</span>
                                <h3 class="banner-process-title"><a href="{{ route('products') }}">Wastewater <br> Treatment</a></h3>
                                <div class="banner-process-content">
                                    Weatherproof MCC and automated control panels engineered for water management facilities.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">05</span>
                                <h3 class="banner-process-title"><a href="{{ route('products') }}">Infrastructure & <br> Utilities</a></h3>
                                <div class="banner-process-content">
                                    Heavy-duty electrical panels built for airports, railways, highways, and public utilities.
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">06</span>
                                <h3 class="banner-process-title"><a href="{{ route('products') }}">Data Centers & <br> Facilities</a></h3>
                                <div class="banner-process-content">
                                    Precision electrical panel systems ensuring uninterrupted power supply for mission-critical facilities.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-process-image-list">
                        <div class="banner-process-img">
                            <div class="process-img">
                                <img src="{{ asset('assets/img/bg-img/banner-process-1.png') }}" alt="img">
                            </div>
                        </div>
                        <div class="banner-process-img">
                            <div class="process-img">
                                <img src="{{ asset('assets/img/bg-img/slider-img-1.png') }}" alt="img">
                            </div>
                        </div>
                        <div class="banner-process-img">
                            <div class="process-img">
                                <img src="{{ asset('assets/img/bg-img/slider-img-2.png') }}" alt="img">
                            </div>
                        </div>
                        <div class="banner-process-img">
                            <div class="process-img">
                                <img src="{{ asset('assets/img/bg-img/video-bg-1.png') }}" alt="img">
                            </div>
                        </div>
                        <div class="banner-process-img">
                            <div class="process-img">
                                <img src="{{ asset('assets/img/bg-img/service-bg-1.png') }}" alt="img">
                            </div>
                        </div>
                        <div class="banner-process-img">
                            <div class="process-img">
                                <img src="{{ asset('assets/img/bg-img/about-bg.png') }}" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ banner-process-area -->
        <!-- ./ Industries We Serve -->
        <!-- ./ Industries We Serve -->

        <!-- Quality Assurance -->
        <section class="about-section-9 pt-130 pb-130 overflow-hidden fade-wrapper bg-white">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top ml-0 mw-100">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Quality Assurance</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Multi-Layered <span>Quality & Safety</span> Process</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center pt-4 gy-4">
                    <div class="col-lg-6">
                        <div class="about-desc">
                            <p class="mb-4 fs-6" style="line-height: 1.8; color: #4a4a4a;">At Possible Electrofeb LLP, quality is not an afterthought — it is built into every phase of our manufacturing process. From raw material sourcing and component inspection to assembly, wiring, and final testing, every step is carefully monitored to ensure our products meet the highest industry benchmarks.</p>
                            <p class="mb-4 fs-6" style="line-height: 1.8; color: #4a4a4a;">We follow a multi-layered quality assurance approach that covers electrical safety verification, functional performance testing, insulation and dielectric checks, wiring accuracy, and compliance validation — all conducted before any panel leaves our facility.</p>
                            <p class="mb-0 fs-6" style="line-height: 1.8; color: #4a4a4a;">Our commitment to quality ensures that every client receives a product that performs reliably, operates safely, and delivers long-term value — whether deployed in a manufacturing plant, a solar energy installation, or critical infrastructure.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-img-1 overflow-hidden" style="border-radius: 20px;">
                            <img src="{{ asset('assets/img/images/content-img-1.png') }}" alt="Quality Assurance" style="width: 100%; height: 380px; object-fit: cover; border-radius: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ Quality Assurance -->

        <!-- Why Choose Us -->
        <section class="why-choose-us-section pt-130 pb-130 fade-wrapper bg-grey">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top ml-0 mw-100 mb-5">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Why Choose Us</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Why Partner With <span>POSSIBLE ELECTROFEB</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center gy-5">
                    <div class="col-lg-7">
                        <div class="row gy-4 pt-2">
                            <div class="col-md-6 fade-top">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-4 bg-white shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease;">
                                    <div class="icon-box flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 48px; height: 48px; background: #0097A0; font-size: 18px;">
                                        <i class="fa-solid fa-user-gear"></i>
                                    </div>
                                    <div>
                                        <h4 class="title mb-1" style="font-size: 18px; font-weight: 500; color: #191919;">Proven Industry Expertise</h4>
                                        <p class="mb-0 text-secondary" style="font-size: 13.5px; line-height: 1.6;">Reliable electrical solutions backed by extensive industry experience and expertise.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 fade-top">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-4 bg-white shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease;">
                                    <div class="icon-box flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 48px; height: 48px; background: #0097A0; font-size: 18px;">
                                        <i class="fa-solid fa-shield-check"></i>
                                    </div>
                                    <div>
                                        <h4 class="title mb-1" style="font-size: 18px; font-weight: 500; color: #191919;">Quality & Safety Assurance</h4>
                                        <p class="mb-0 text-secondary" style="font-size: 13.5px; line-height: 1.6;">Using premium components and tested to ensure maximum safety & durability.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 fade-top">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-4 bg-white shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease;">
                                    <div class="icon-box flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 48px; height: 48px; background: #0097A0; font-size: 18px;">
                                        <i class="fa-solid fa-gears"></i>
                                    </div>
                                    <div>
                                        <h4 class="title mb-1" style="font-size: 18px; font-weight: 500; color: #191919;">Customized Engineering</h4>
                                        <p class="mb-0 text-secondary" style="font-size: 13.5px; line-height: 1.6;">Tailor-made solutions designed to meet specific project and operational requirements.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 fade-top">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-4 bg-white shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease;">
                                    <div class="icon-box flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 48px; height: 48px; background: #0097A0; font-size: 18px;">
                                        <i class="fa-solid fa-industry"></i>
                                    </div>
                                    <div>
                                        <h4 class="title mb-1" style="font-size: 18px; font-weight: 500; color: #191919;">Advanced Manufacturing Facility</h4>
                                        <p class="mb-0 text-secondary" style="font-size: 13.5px; line-height: 1.6;">Modern manufacturing infrastructure ensuring precision and consistent quality.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 fade-top">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-4 bg-white shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease;">
                                    <div class="icon-box flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 48px; height: 48px; background: #0097A0; font-size: 18px;">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </div>
                                    <div>
                                        <h4 class="title mb-1" style="font-size: 18px; font-weight: 500; color: #191919;">Timely Project Delivery</h4>
                                        <p class="mb-0 text-secondary" style="font-size: 13.5px; line-height: 1.6;">Manufacturing capabilities and efficient project management ensure on-time delivery.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 fade-top">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-4 bg-white shadow-sm h-100" style="border-radius: 16px; transition: all 0.3s ease;">
                                    <div class="icon-box flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 48px; height: 48px; background: #0097A0; font-size: 18px;">
                                        <i class="fa-solid fa-headset"></i>
                                    </div>
                                    <div>
                                        <h4 class="title mb-1" style="font-size: 18px; font-weight: 500; color: #191919;">End-to-End Support</h4>
                                        <p class="mb-0 text-secondary" style="font-size: 13.5px; line-height: 1.6;">Dedicated technical assistance from design consultation to after-sales service.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="position-relative slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <div class="overflow-hidden shadow-lg" style="border-radius: 20px;">
                                <img src="{{ asset('assets/img/images/process-img-5.png') }}" alt="Why Choose Us" style="width: 100%; height: 500px; object-fit: cover; border-radius: 20px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ Why Choose Us -->

        <!-- Testing & Inspection -->
        <section class="process-section process-6 pt-130 pb-130 fade-wrapper bg-grey">
            <div class="container container-2">
                <div class="row section-heading-wrap ml-0 mw-100 fade-top">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Testing & Inspection</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Standardized <span>Quality Inspection</span> Protocols</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="process-img-6 slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
                            <img src="{{ asset('assets/img/images/process-img-5.png') }}" alt="Testing and Inspection">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="process-item-wrap-6 slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <div class="process-item-6 item-1">
                                <span class="number">01</span>
                                <h3 class="title"><span></span> Electrical safety verification</h3>
                            </div>
                            <div class="process-item-6">
                                <span class="number">02</span>
                                <h3 class="title"><span></span> Routine functional testing</h3>
                            </div>
                            <div class="process-item-6">
                                <span class="number">03</span>
                                <h3 class="title"><span></span> Component quality inspection</h3>
                            </div>
                            <div class="process-item-6">
                                <span class="number">04</span>
                                <h3 class="title"><span></span> Wiring and fabrication checks</h3>
                            </div>
                            <div class="process-item-6">
                                <span class="number">05</span>
                                <h3 class="title"><span></span> Final performance testing</h3>
                            </div>
                            <div class="process-item-6">
                                <span class="number">06</span>
                                <h3 class="title"><span></span> Compliance & standards validation</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ Testing & Inspection -->

        <!-- CTA Section -->
        <section class="newsletter-section bg-white pt-130 pb-130 overflow-hidden">
            <div class="bg-shape"><img src="{{ asset('assets/img/shapes/newsletter-shape.png') }}" alt="shape"></div>
            <div class="container">
                <div class="newsletter-wrap">
                    <div class="section-heading text-center align-items-center">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Build A Dependable Partnership</h4>
                        <h2 class="section-title">Powering <span>Sustainable Growth</span> & Progress</h2>
                        <p class="mb-4">Whether you need a custom MCC panel, a solar ACDB/DCDB system, or a complete power distribution solution — our team is ready to collaborate, engineer, and deliver a product built for your exact requirements. Let's build something reliable together.</p>
                        <div>
                            <a href="{{ route('contact') }}" class="tl-primary-btn">Contact Our Team <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ CTA Section -->
@endsection
