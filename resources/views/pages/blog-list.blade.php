@extends('layouts.master')

@section('title', 'Blog List - Antra Architecture & Interior Design')

@section('content')
<div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Blog</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("blog.list") }}'> Blog</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="blog-section pt-130 pb-130 fade-wrapper">
            <div class="container container-2">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        @forelse($blogs as $blog)
                            @if($loop->first)
                                <div class="post-card inner-post">
                                    <div class="post-thumb">
                                        @if($blog->featuredMedia)
                                            <img src="{{ asset('storage/' . $blog->featuredMedia->file_path) }}" alt="{{ $blog->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/blog/post-inner-1.png') }}" alt="{{ $blog->title }}">
                                        @endif
                                    </div>
                                    <div class="post-content">
                                        <ul class="post-meta">
                                            <li class="category">{{ $blog->category ? $blog->category->name : 'General' }}</li>
                                            <li>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</li>
                                            <li>By <span>{{ $blog->author ? $blog->author->name : 'Admin' }}</span></li>
                                        </ul>
                                        <h3 class="title"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                                        <p>{{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 200) }}</p>
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="read-more">Read More</a>
                                    </div>
                                </div>
                                @if($blogs->count() > 1)
                                    <div class="post-card-wrap post-card-wrap-inner">
                                @endif
                            @else
                                <div class="post-card">
                                    <div class="post-thumb">
                                        @if($blog->featuredMedia)
                                            <img src="{{ asset('storage/' . $blog->featuredMedia->file_path) }}" alt="{{ $blog->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/blog/post-6.png') }}" alt="{{ $blog->title }}">
                                        @endif
                                    </div>
                                    <div class="post-content">
                                        <ul class="post-meta">
                                            <li class="category">{{ $blog->category ? $blog->category->name : 'General' }}</li>
                                            <li>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</li>
                                            <li>By <span>{{ $blog->author ? $blog->author->name : 'Admin' }}</span></li>
                                        </ul>
                                        <h3 class="title"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                                        <p>{{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}</p>
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="read-more">Read More</a>
                                    </div>
                                </div>
                            @endif

                            @if($loop->last && $blogs->count() > 1)
                                    </div>
                            @endif
                        @empty
                            <div class="post-card inner-post py-5 text-center">
                                <h3 class="title">No blog posts found</h3>
                                <p>We haven't published any articles in this category or search query yet.</p>
                                <a href="{{ route('blogs') }}" class="read-more">View All Posts</a>
                            </div>
                        @endforelse

                        @if($blogs->hasPages())
                            <div class="mt-100 d-flex justify-content-center">
                                {{ $blogs->links() }}
                            </div>
                        @endif
                    </div>
                    <!-- Sidebar Widgets -->
                    <div class="col-lg-4">
                        <div class="sidebar-widget">
                            <h3 class="widget-title">Search</h3>
                            <div class="search-box">
                                <form action="{{ route('blog.list') }}" method="GET" class="search-form">
                                    <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                    <button class="search-btn" type="submit">
                                        <i class="fa-regular fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="category-list">
                                @forelse($categories as $cat)
                                    <li>
                                        <a href="{{ route('blog.list', ['category' => $cat->slug]) }}">
                                            {{ $cat->name }}
                                            @if($cat->blogs_count > 0)
                                                <span>({{ $cat->blogs_count }})</span>
                                            @endif
                                        </a>
                                    </li>
                                @empty
                                    <li><a href="#">No categories found</a></li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="sidebar-widget">
                            <h3 class="widget-title">Recent Post</h3>
                            @forelse($recentBlogs as $recent)
                                <div class="sidebar-post">
                                    @if($recent->featuredMedia)
                                        <img src="{{ asset('storage/' . $recent->featuredMedia->file_path) }}" alt="{{ $recent->title }}" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/img/blog/sidebar-post-1.png') }}" alt="{{ $recent->title }}">
                                    @endif
                                    <div class="post-content">
                                        <ul class="post-meta">
                                            <li>{{ $recent->published_at ? $recent->published_at->format('M d, Y') : $recent->created_at->format('M d, Y') }}</li>
                                        </ul>
                                        <h3 class="title"><a href="{{ route('blog.show', $recent->slug) }}">{{ $recent->title }}</a></h3>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No recent posts found.</p>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </section>
@endsection
