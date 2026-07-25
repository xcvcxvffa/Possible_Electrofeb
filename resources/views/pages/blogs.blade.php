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
                                <h3 class="title"><a href="{{ route('blog.single') }}">Transform Your Home With the Modern Interior Design Tips</a></h3>
                                <p>Modern interior design is all about creating a sleek, functional, and aesthetically pleasing space that reflects contemporary living. Whether you’re updating a single room or redesigning your entire home, incorporating modern interior design principles can bring a fresh.</p>
                                <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                            </div>
                        </div>
                        <div class="post-card-wrap post-card-wrap-inner">
                            <div class="post-card">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-6.png') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li class="category">exteriors</li>
                                        <li>Dec 25, 2025</li>
                                        <li>By <span>Admin</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Maximize Your Minimalist Space With Smart Solutions</a></h3>
                                    <p>Modest, recently established interior design company that seeks to address a variety of topics, including…</p>
                                    <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                                </div>
                            </div>
                            <div class="post-card">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-5.png') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li class="category">exteriors</li>
                                        <li>Dec 25, 2025</li>
                                        <li>By <span>Admin</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Perfectly Redefining Interior Spaces for Modern Lifestyles</a></h3>
                                    <p>Modest, recently established interior design company that seeks to address a variety of topics, including…</p>
                                    <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                                </div>
                            </div>
                            <div class="post-card">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-4.png') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li class="category">exteriors</li>
                                        <li>Dec 25, 2025</li>
                                        <li>By <span>Admin</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Modern Materials That Elevate Your Home’s Functionality</a></h3>
                                    <p>Modest, recently established interior design company that seeks to address a variety of topics, including…</p>
                                    <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                                </div>
                            </div>
                            <div class="post-card">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-3.png') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li class="category">exteriors</li>
                                        <li>Dec 25, 2025</li>
                                        <li>By <span>Admin</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Modern Rooms Creating Elegant Spaces for Relaxation</a></h3>
                                    <p>Modest, recently established interior design company that seeks to address a variety of topics, including…</p>
                                    <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                                </div>
                            </div>
                            <div class="post-card">
                                <div class="post-thumb">
                                    <img src="{{ asset('assets/img/blog/post-2.png') }}" alt="post">
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li class="category">exteriors</li>
                                        <li>Dec 25, 2025</li>
                                        <li>By <span>Admin</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Luxury Living Redefined Elegant for the Modern Home</a></h3>
                                    <p>Modest, recently established interior design company that seeks to address a variety of topics, including…</p>
                                    <a href="{{ route('blog.single') }}" class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                        <ul class="pagination-wrap mt-100 justify-content-center">
                            <li><a href="#">1</a></li>
                            <li><a href="#" class="active">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fa-regular fa-arrow-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- Sidebar Widgets -->
                    <div class="col-lg-4">
                        <div class="sidebar-widget">
                            <h3 class="widget-title">Search</h3>
                            <div class="search-box">
                                <form action="#" class="search-form">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button class="search-btn" type="button">
                                        <i class="fa-regular fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="category-list">
                                <li><a href="{{ route('blogs') }}">Accessories</a></li>
                                <li><a href="{{ route('blogs') }}">Electrical & Lighting</a></li>
                                <li><a href="{{ route('blogs') }}">Home Appliance</a></li>
                                <li><a href="{{ route('blogs') }}">Power Tools</a></li>
                                <li><a href="{{ route('blogs') }}">Uncategorized</a></li>
                                <li><a href="{{ route('blogs') }}">Ware Accessories</a></li>
                            </ul>
                        </div>
                        <div class="sidebar-widget">
                            <h3 class="widget-title">Recent Post</h3>
                            <div class="sidebar-post">
                                <img src="{{ asset('assets/img/blog/sidebar-post-1.png') }}" alt="post">
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li>Sep 10, 2025</li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Maximize Your Minimalist Space With Smart Solutions</a></h3>
                                </div>
                            </div>
                            <div class="sidebar-post">
                                <img src="{{ asset('assets/img/blog/sidebar-post-2.png') }}" alt="post">
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li>Sep 10, 2025</li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Exploring Trends and Techniques in Interior Design</a></h3>
                                </div>
                            </div>
                            <div class="sidebar-post">
                                <img src="{{ asset('assets/img/blog/sidebar-post-3.png') }}" alt="post">
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li>Sep 10, 2025</li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">The Aesthetics Agenda: Redefining Interior Elegance</a></h3>
                                </div>
                            </div>
                            <div class="sidebar-post">
                                <img src="{{ asset('assets/img/blog/sidebar-post-4.png') }}" alt="post">
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li>Sep 10, 2025</li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.single') }}">Transforming Spaces into Dream Dwellings</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget sticky-widget">
                            <h3 class="widget-title">Tags</h3>
                            <ul class="tags">
                                <li><a href="{{ route('blogs') }}">Architechture</a></li>
                                <li><a href="{{ route('blogs') }}">Construction</a></li>
                                <li><a href="{{ route('blogs') }}">Furniture</a></li>
                                <li><a href="{{ route('blogs') }}">Design </a></li>
                                <li><a href="{{ route('blogs') }}">Interior</a></li>
                                <li><a href="{{ route('blogs') }}">Kitchen</a></li>
                                <li><a href="{{ route('blogs') }}">Living Room</a></li>
                                <li><a href="{{ route('blogs') }}">Building</a></li>
                                <li><a href="{{ route('blogs') }}">Planning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
