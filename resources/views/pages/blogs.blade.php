@extends('layouts.master')

@section('title', 'Blogs - Antra Architecture & Interior Design')
@section('meta_description', 'Discover modern interior design tips, architectural insights, and industry trends.')
@section('meta_keywords', 'architecture blog, interior design tips, modern living, design trends')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Blog</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("blogs") }}'> Blog</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="blog-section pt-130 pb-130 fade-wrapper">
            <div class="container container-2">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="post-inner-card-wrap">
                            <div class="post-card inner-post">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-inner-1.png') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li class="category">exteriors</li>
                                        <li>Dec 25, 2025</li>
                                        <li>By <span>Admin</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Transform Your Home With Modern Interior Design Tips</a></h3>
                                    <p>Modern interior design is all about creating a sleek, functional, and aesthetically pleasing space that reflects contemporary living.</p>
                                    <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                                </div>
                            </div>
                            <div class="post-card inner-post">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-inner-2.png') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li class="category">exteriors</li>
                                        <li>Dec 25, 2025</li>
                                        <li>By <span>Admin</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Maximize Your Minimalist Space With Smart Solutions</a></h3>
                                    <p>Discover creative techniques for maximizing utility and aesthetics in compact residential environments.</p>
                                    <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Widgets -->
                    <div class="col-lg-4">
                        <div class="sidebar-widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="category-list">
                                <li><a href="{{ route('blogs') }}">Accessories</a></li>
                                <li><a href="{{ route('blogs') }}">Electrical & Lighting</a></li>
                                <li><a href="{{ route('blogs') }}">Home Appliance</a></li>
                                <li><a href="{{ route('blogs') }}">Power Tools</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
