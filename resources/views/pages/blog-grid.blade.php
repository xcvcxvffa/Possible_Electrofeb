@extends('layouts.master')

@section('title', 'Blog Grid - Antra Architecture & Interior Design')

@section('content')
<div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Blog</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("blog.grid") }}'> Blog</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="blog-section pt-150 pb-150 fade-wrapper">
            <div class="container container-2">
                <div class="row gy-5 fade-wrapper">
                    @forelse($blogs as $blog)
                        <div class="col-lg-4 col-md-6 fade-top">
                            <div class="post-card">
                                <div class="post-thumb">
                                    @if($blog->featuredMedia)
                                        <img src="{{ asset('storage/' . $blog->featuredMedia->file_path) }}" alt="{{ $blog->title }}">
                                    @else
                                        <img src="{{ asset('assets/img/blog/post-' . (($loop->index % 6) + 1) . '.jpg') }}" alt="{{ $blog->title }}">
                                    @endif
                                    <span class="category">{{ $blog->category ? $blog->category->name : 'exteriors' }}</span>
                                </div>
                                <div class="post-content">
                                    <ul class="post-meta">
                                        <li>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</li>
                                        <li>By <span>{{ $blog->author ? $blog->author->name : 'Admin' }}</span></li>
                                    </ul>
                                    <h3 class="title"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                                    <p>{{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h3>No blog posts found</h3>
                            <p>Check back soon for new articles!</p>
                        </div>
                    @endforelse
                </div>

                @if($blogs->hasPages())
                    <div class="mt-100 d-flex justify-content-center">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>
        </section>
@endsection
