@extends('layouts.master')

@section('title', 'Contact Us - Antra Architecture & Interior Design')
@section('meta_description', 'Have a project in mind? Get in touch with our team of architecture and interior design experts.')
@section('meta_keywords', 'contact antra, architecture inquiry, interior design consultation, phone, email')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Contact Us</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("contact") }}'> Contact Us</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="contact-section pt-150 pb-150">
            <div class="container container-2">
                <div class="row section-heading-wrap w-100 ml-0">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">get in touch</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title title-2">Have a Project in <span>Mind? Let’s <br> Make</span> It Happen</h2>
                        </div>
                    </div>
                </div>
                <div class="row request-wrap contact-page-area">
                    <div class="col-lg-6">
                        <div class="request-content">
                            <div class="request-item-wrap">
                                <div class="request-item white-content">
                                    <span>Address</span>
                                    <p>Plot No.04, Shital Ind. Area, Opp Jamwadi G.I, opp. Vraj Cold Storage, D.C, Jamwadi, Gondal, Gujarat 360311</p>
                                </div>
                                <div class="request-item white-content">
                                    <span>Support</span>
                                    <a href="tel:+918200268204">+91 82002 68204</a>
                                    <a href="mailto:electrofeb@possiblegroups.com">electrofeb@possiblegroups.com</a>
                                </div>
                            </div>
                            <div class="contact-img">
                                <img src="{{ asset('assets/img/images/contact-img-1.png') }}" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="request-form-wrap">
                            <form action="#" method="post" id="ajax_contact" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Full Name *</h4>
                                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="e.g. John Doe">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Phone *</h4>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="e.g. +91 98765 43210">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Email Address *</h4>
                                            <input type="text" id="email" name="email" class="form-control" placeholder="e.g. john@example.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Select Product *</h4>
                                            <select id="service" name="service" class="form-control form-select" style="height: 52px; background-color: #ffffff; border: 1px solid #e3e3e0; color: #1b1b18; font-size: 14.5px; border-radius: 8px;">
                                                <option value="" selected disabled>-- Select Product --</option>
                                                <option value="LT PCC PANELS">LT PCC PANELS</option>
                                                <option value="LT AC COMBINER PANELS">LT AC COMBINER PANELS</option>
                                                <option value="LT MCC PANEL">LT MCC PANEL</option>
                                                <option value="APFC PANEL">APFC PANEL</option>
                                                <option value="METER PANEL">METER PANEL</option>
                                                <option value="SOLAR ACDB / DCDB PANEL">SOLAR ACDB / DCDB PANEL</option>
                                                <option value="CABLE TRAY SYSTEM">CABLE TRAY SYSTEM</option>
                                                <option value="General Inquiry">General Inquiry / Custom Solution</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">
                                            <h4 class="form-title">Write Message <span style="font-weight: 400; font-size: 13px; color: #777777;">(Optional)</span></h4>
                                            <textarea id="message" name="message" cols="30" rows="5" class="form-control address" placeholder="Write your message here (optional)..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button id="submit" class="tl-primary-btn" type="submit">Send Message <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ contact-section -->
        
        <div class="map-wrapper pb-150">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8826.923787362664!2d-118.27754354757262!3d34.03471770929568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20California%2C%20Hoa%20K%E1%BB%B3!5e0!3m2!1svi!2s!4v1566525118697!5m2!1svi!2s" width="100%" height="620" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
@endsection
