@extends('layouts.master')

@section('title', 'Possible Electrofeb LLP')

@section('content')
<style>
/* Custom Mobile Responsiveness for Home Page */
@media (max-width: 991px) {
    .pt-130 { padding-top: 80px !important; }
    .pb-130 { padding-bottom: 80px !important; }
    .pt-120 { padding-top: 70px !important; }
    .pb-120 { padding-bottom: 70px !important; }
    .section-title { font-size: 36px !important; line-height: 1.3 !important; }
    .section-title.title-2 { font-size: 30px !important; }
}
@media (max-width: 767px) {
    .pt-130 { padding-top: 60px !important; }
    .pb-130 { padding-bottom: 60px !important; }
    .pt-120 { padding-top: 50px !important; }
    .pb-120 { padding-bottom: 50px !important; }
    .section-title { font-size: 28px !important; }
    .section-title.title-2 { font-size: 24px !important; }
    body { overflow-x: hidden; }
    .about-content-9 { display: flex !important; flex-direction: column !important; }
    .about-counter { display: flex !important; flex-direction: column !important; align-items: center; justify-content: center; margin-bottom: 25px !important; text-align: center; width: 100%; }
    .about-counter .title { font-size: 100px !important; line-height: 1 !important; margin: 0 !important; }
    .about-counter p { writing-mode: horizontal-tb !important; transform: none !important; margin-top: 10px !important; font-size: 18px !important; letter-spacing: normal !important; position: static !important; }
    .about-btn { text-align: center; }
}
</style>
<div id="antra-smooth-wrapper">
    <div id="antra-smooth-content">

        <!-- Video Hero Section -->
        <section class="slider-section slider-ready overflow-hidden position-relative">
            <div class="slider-item position-relative overflow-hidden">
                <!-- Video Background -->
                <div class="hero-video-wrapper">
                    <video autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline" poster="{{ asset('assets/img/bg-img/slider-img-1.png') }}" class="hero-video-bg">
                       <source src="{{ asset('assets/Video/Possible_Video.mp4') }}" type="video/mp4">
                    </video>
                    <div class="hero-video-overlay"></div>
                </div>

                <div class="container slider-container position-relative z-index-2">
                    <div class="slider-content-wrap">
                        <div class="slider-content">
                            <div class="section-heading white-content">
                                <h4 class="sub-heading" data-animation="antra-fadeInDown" data-delay="1000ms" data-duration="1400ms">Innovating Power</h4>
                                <h2 class="section-title cursor-effect" data-animation="antra-fadeInDown" data-delay="1200ms" data-duration="1400ms">Engineering Excellence in <br> Power Distribution</h2>
                            </div>
                            <div class="bottom-content">
                                <div class="antra-desc" data-animation="antra-fadeInUp" data-delay="1000ms" data-duration="1400ms">
                                    <p>Delivering precision-engineered electrical panel solutions that power industries <br>with safety, quality, and long-term reliability.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ slider-section -->

        <!-- About Section -->
        <section class="about-section-9 pt-130 pb-130 overflow-hidden fade-wrapper tl-bg-color">
            <div class="shape-1"><img src="{{ asset('assets/img/shapes/about-shape-8.png') }}" alt="shape"></div>
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">About Possible Electrofeb</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">We Shape <span>Electrical Panels & Engineering</span> Solutions For Modern Industries</h2>
                        </div>
                    </div>
                </div>
                <div class="about-img-9 fade-top">
                    <img src="{{ asset('assets/img/images/Possible_About.webp') }}" alt="Possible Electrofeb About Us">
                </div>
                <div class="about-content-9 fade-top">
                    <div class="about-counter">
                        <h3 class="title"><span class="odometer" data-count="{{ $setting?->years_of_experience ?? 15 }}">0</span></h3>
                        <p>years of work <br>experience</p>
                    </div>
                    <div class="about-desc">
                        <p>POSSIBLE ELECTROFEB  is dedicated to delivering reliable and efficient electrical panel solutions for industrial,commercial, infrastructure and renewable energy applications. We focus on providing high-quality power distribution and control systems that ensure safety, performance and long-term operational reliability.</p>
                        <div class="about-btn">
                            <a href="{{ route('about') }}" class="tl-primary-btn">More About Us <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ about-section -->

        <!-- Product Section -->
        <section class="service-section-2 fade-wrapper bg-grey pt-130 pb-130 service-9">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Our Products</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Explore our <span>high-performance electrical panel</span> products</h2>
                        </div>
                    </div>
                </div>
                <div class="service-carousel swiper fade-top">
                    <div class="swiper-wrapper">
                        @foreach($globalProducts as $index => $product)
                        <div class="swiper-slide">
                            <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                                <div class="service-thumb">
                                    @if($product->cardMedia && $product->cardMedia->file_path)
                                        <img src="{{ asset('storage/'.$product->cardMedia->file_path) }}" alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/service/service-img-1.png') }}" alt="{{ $product->name }}">
                                    @endif
                                    <span class="number">{{ sprintf('%02d', $index + 1) }}</span>
                                </div>
                                <div class="service-content">
                                    <h5 class="title">{{ strtoupper($product->name) }}</h5>
                                    <p>{{ Str::limit($product->short_description ?? 'High-capacity electrical panels designed for robust power distribution and safety.', 90) }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ service-section -->

        <section class="counter-section counter-1 overflow-hidden pt-120 pb-120">
            <div class="counter-text"><span>Possible</span></div>
            <div class="container container-2 position-relative z-index-2">
                <div class="row gy-5 fade-wrapper">
                    <div class="col-lg-3 col-md-6 fade-top">
                        <div class="counter-item">
                            <h3 class="title"><span class="odometer" data-count="{{ $setting?->completed_projects ?? 500 }}">0</span><span class="icon">+</span></h3>
                            <h4 class="sub-title">Projects completed</h4>
                            <p>Industrial panel & distribution projects successfully delivered</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 fade-top">
                        <div class="counter-item">
                            <h3 class="title"><span class="odometer" data-count="{{ $setting?->years_of_experience ?? 15 }}">0</span><span class="icon">+</span></h3>
                            <h4 class="sub-title">Years experience</h4>
                            <p>Delivering high quality electrical & engineering solutions for years</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 fade-top">
                        <div class="counter-item">
                            <h3 class="title"><span class="odometer" data-count="{{ $setting?->happy_clients ?? 200 }}">0</span><span class="icon">+</span></h3>
                            <h4 class="sub-title">Happy clients</h4>
                            <p>Long term reliability and trusted partnership across industries</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 fade-top">
                        <div class="counter-item">
                            <h3 class="title"><span class="odometer" data-count="{{ $setting?->products_delivered ?? 9 }}">0</span><span class="icon">+</span></h3>
                            <h4 class="sub-title">Panel types</h4>
                            <p>Diverse range of custom electrical panels manufactured to perfection</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ counter-section -->

        <!-- How We Work Section (from Home-6) -->
        <section class="process-section process-6 pt-130 pb-130 fade-wrapper">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">How We Work</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Streamlined <span>Electrical <br>Engineering</span> Process For Reliable Results</h2>
                            <p>We combine technical expertise, rigorous quality standards, and customer-centric planning <br> to deliver custom electrical panel and power management solutions.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="process-img-6 slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
                            <img src="{{ asset('assets/img/images/How_We_Work.webp') }}" alt="How We Work">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="process-item-wrap-6 slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <div class="process-item-6 item-1">
                                <span class="number">01</span>
                                <h3 class="title">Requirement Analysis</h3>
                                <p>We evaluate your electrical load, single-line diagrams, and site specifications.</p>
                            </div>
                            <div class="process-item-6">
                                <span class="number">02</span>
                                <h3 class="title">CAD & 3D Panel Design</h3>
                                <p>Our engineers craft custom CAD schematics and 3D enclosure layouts.</p>
                            </div>
                            <div class="process-item-6">
                                <span class="number">03</span>
                                <h3 class="title">Precision Fabrication</h3>
                                <p>State-of-the-art sheet metal fabrication, busbar bending, and component wiring.</p>
                            </div>
                            <div class="process-item-6">
                                <span class="number">04</span>
                                <h3 class="title">Testing & Commissioning</h3>
                                <p>Comprehensive high-voltage, insulation, and functional testing before site installation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ process-section -->





        <section class="sponsor-section sponsor-1 bg-grey pt-120 pb-130 overflow-hidden">
            <div class="container">
                <div class="sponsor-carousel swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <a href="#"><img src="{{ asset('assets/img/sponsor/sponsor-1.png') }}" alt="sponsor"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <a href="#"><img src="{{ asset('assets/img/sponsor/sponsor-2.png') }}" alt="sponsor"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <a href="#"><img src="{{ asset('assets/img/sponsor/sponsor-3.png') }}" alt="sponsor"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <a href="#"><img src="{{ asset('assets/img/sponsor/sponsor-4.png') }}" alt="sponsor"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <a href="#"><img src="{{ asset('assets/img/sponsor/sponsor-5.png') }}" alt="sponsor"></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <a href="#"><img src="{{ asset('assets/img/sponsor/sponsor-6.png') }}" alt="sponsor"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ sponsor-section -->




        <section class="video-section">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/video-bg-1.png') }}"></div>
            <div class="container container-2">
                <div class="video-content">
                    <div class="play-btn">
                        <a
                            class="video-popup venobox"
                            data-autoplay="true"
                            data-vbtype="video"
                            href="https://youtu.be/JwC-Qx1lJso">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                    <h2 class="video-title">Unlock Your Dream <br> Home Today!</h2>
                    <p>We encourage clients to actively participate in discussions, share their ideas, preferences, and feedback.</p>
                </div>
            </div>
        </section>
        <!-- ./ video-section -->

        <section class="blog-section pt-150 fade-wrapper tl-bg-color">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top">  
                    <div class="shape"><img src="{{ asset('assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Latest News</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Stay Updated <span>With Our <br> Latest</span> Articles</h2>
                        </div>
                    </div>
                </div>
                <div class="blog-carousel swiper fade-top">
                    <div class="swiper-wrapper">
                        @forelse($latestBlogs as $post)
                        <div class="swiper-slide">
                            <div class="post-card">
                                <div class="post-thumb">
                                    @if($post->featuredMedia)
                                        <img src="{{ asset('storage/' . $post->featuredMedia->file_path) }}" alt="{{ $post->title }}">
                                    @else
                                        <img src="{{ asset('assets/img/blog/post-1.jpg') }}" alt="{{ $post->title }}">
                                    @endif
                                    @if($post->category)
                                        <span class="category">{{ $post->category->name }}</span>
                                    @endif
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li>{{ ($post->published_at ?? $post->created_at)->format('M d, Y') }}</li>
                                        <li>By <span>{{ $post->author ? $post->author->name : 'Admin' }}</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                                    <p>{{ Str::limit(strip_tags($post->excerpt ?: $post->content), 90) }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="swiper-slide">
                            <div class="post-card">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-1.jpg') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <p class="text-muted">No blog posts found.</p>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ blog-section -->

        <div class="gallary-section overflow-hidden">
            <div class="gallary-text"><span>gallery</span></div>
            <div class="gallary-wrap wrap-1">
                <div class="gallery-scroll-wrap">
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-6.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-6.png') }}" alt="img"></a>
                    </div>
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-7.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-7.png') }}" alt="img"></a>
                    </div>
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-8.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-8.png') }}" alt="img"></a>
                    </div>
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-9.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-9.png') }}" alt="img"></a>
                    </div>
                </div>
            </div>
            <div class="gallary-wrap gallery-scroll-direction-ltr">
                <div class="gallery-scroll-wrap align-items-start">
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-10.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-10.png') }}" alt="img"></a>
                    </div>
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-11.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-11.png') }}" alt="img"></a>
                    </div>
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-12.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-12.png') }}" alt="img"></a>
                    </div>
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('assets/img/project/project-img-13.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('assets/img/project/project-img-13.png') }}" alt="img"></a>
                    </div>
                </div>
            </div>
        </div>

        <section class="newsletter-section pb-130 overflow-hidden tl-bg-color fade-wrapper">
            <div class="bg-shape"><img src="{{ asset('assets/img/shapes/newsletter-shape.png') }}" alt="shape"></div>
            <div class="container">
                <div class="newsletter-wrap">
                    <div class="section-heading text-center fade-top">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Subscribe to the newsletter</h4>
                        <h2 class="section-title cursor-effect">Join <span>our newsletter <br> stay</span> up to date</h2>
                        <p class="fade-top">Join our newsletter. Learn something new, gain access to exclusive content, <br> and stay informed with the latest updates in the industry.</p>
                    </div>
                    <div class="newsletter-form fade-top">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email address..">
                        <button type="submit"><i class="fa-regular fa-arrow-right-long"></i></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ newsletter-section -->
@endsection

