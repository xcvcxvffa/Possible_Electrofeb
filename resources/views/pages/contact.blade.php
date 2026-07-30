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
                                    <p>{{ $setting?->company_address ?? 'Plot No.04, Shital Ind. Area, Opp Jamwadi G.I, opp. Vraj Cold Storage, D.C, Jamwadi, Gondal, Gujarat 360311' }}</p>
                                </div>
                                <div class="request-item white-content">
                                    <span>Support</span>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $setting?->company_phone ?? '+918200268204') }}">{{ $setting?->company_phone ?? '+91 82002 68204' }}</a>
                                    <a href="mailto:{{ $setting?->company_email ?? 'electrofeb@possiblegroups.com' }}">{{ $setting?->company_email ?? 'electrofeb@possiblegroups.com' }}</a>
                                </div>
                            </div>
                            <div class="contact-img">
                                <img src="{{ asset('assets/img/images/contact-img-1.png') }}" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px; margin-bottom: 25px;">
                                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="request-form-wrap">
                            <form action="{{ route('contact.submit') }}" method="POST" id="contact-form" class="request-form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Full Name *</h4>
                                            <input type="text" id="fullname" name="fullname" class="form-control @error('fullname') is-invalid @enderror" placeholder="e.g. John Doe" value="{{ old('fullname') }}">
                                            @error('fullname') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Phone *</h4>
                                            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="e.g. +91 98765 43210" value="{{ old('phone') }}">
                                            @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" style="position: relative; z-index: 99;">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Email Address *</h4>
                                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="e.g. john@example.com" value="{{ old('email') }}">
                                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <style>
                                                /* Ensure all single-line inputs and dropdown have exactly the same dimensions */
                                                .request-form-wrap .form-item input.form-control,
                                                .request-form-wrap .form-item .nice-select.form-control {
                                                    height: 58px;
                                                    background-color: #ffffff;
                                                    border: none;
                                                    border-radius: 24px;
                                                    width: 100%;
                                                }
                                                .request-form-wrap .form-item .nice-select.form-control {
                                                    padding: 0 20px; /* Horizontal padding only, height handles vertical centering */
                                                    display: flex;
                                                    align-items: center;
                                                }
                                                .request-form-wrap .form-item .nice-select.form-control::after {
                                                    right: 25px;
                                                }
                                            </style>
                                            <h4 class="form-title">Select Product *</h4>
                                            <select id="service" name="service" class="form-control form-select @error('service') is-invalid @enderror">
                                                <option value="" selected disabled>-- Select Product --</option>
                                                @foreach($globalProducts as $contactProduct)
                                                <option value="{{ strtoupper($contactProduct->name) }}" {{ old('service') == strtoupper($contactProduct->name) ? 'selected' : '' }}>{{ strtoupper($contactProduct->name) }}</option>
                                                @endforeach
                                                <option value="General Inquiry" {{ old('service') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry / Custom Solution</option>
                                            </select>
                                            @error('service') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">
                                            <h4 class="form-title">Write Message <span style="font-weight: 400; font-size: 13px; color: #777777;">(Optional)</span></h4>
                                            <textarea id="message" name="message" cols="30" rows="5" class="form-control address @error('message') is-invalid @enderror" placeholder="Write your message here (optional)...">{{ old('message') }}</textarea>
                                            @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
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
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d284.61298043043945!2d70.76555238056405!3d21.939460989790092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39583902a873eaed%3A0xfdb37b1b2f347403!2sPossible%20Electrofeb%20LLP!5e1!3m2!1sen!2sin!4v1784953350218!5m2!1sen!2sin" width="100%" height="620" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
@endsection
