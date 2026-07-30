@extends('layouts.master')

@section('title', isset($blog) && $blog->seo && $blog->seo->meta_title ? $blog->seo->meta_title : ($blog->title ?? 'Blog Details') . ' - Possible Electrofeb')
@section('meta_description', isset($blog) && $blog->seo && $blog->seo->meta_description ? $blog->seo->meta_description : ($blog->excerpt ?? ''))
@section('meta_keywords', isset($blog) && $blog->seo && $blog->seo->meta_keywords ? $blog->seo->meta_keywords : '')

@section('content')
<div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title" style="font-size: 40px;">{{ $blog->title }}</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("blog.standard") }}'> Blog Details</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="blog-details pt-150 pb-150 overflow-hidden">
            <div class="container container-2">
                <div class="row gy-5 justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="blog-details-wrap">
                            <div class="post-card post-card-2 inner-post">
                                <div class="post-content">
                                    <ul class="post-meta">
                                        @if($blog->category)
                                            <li class="category">{{ $blog->category->name }}</li>
                                        @endif
                                        <li>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</li>
                                        <li>By <span>{{ $blog->author ? $blog->author->name : 'Admin' }}</span></li>
                                        @if($blog->reading_time)
                                            <li>{{ $blog->reading_time }} min read</li>
                                        @endif
                                    </ul>
                                    <h3 class="title">{{ $blog->title }}</h3>
                                </div>
                            </div>

                            <div class="blog-details-img mb-30">
                                @if($blog->featuredMedia)
                                    <img src="{{ asset('storage/' . $blog->featuredMedia->file_path) }}" alt="{{ $blog->title }}">
                                @else
                                    <img src="{{ asset('assets/img/blog/blog-details-img.png') }}" alt="{{ $blog->title }}">
                                @endif
                            </div>

                            <div class="blog-details-content">
                                {!! $blog->content !!}
                            </div>

                            {{-- Gallery images (if available) — reuses theme's .details-img-wrap structure --}}
                            @if($blog->gallery && $blog->gallery->count() > 0)
                                <div class="details-img-wrap mt-40 mb-40">
                                    @foreach($blog->gallery as $gItem)
                                        @if($gItem->media)
                                            <img src="{{ asset('storage/' . $gItem->media->file_path) }}" alt="{{ $blog->title }}">
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            {{-- Downloadable documents (if available) --}}
                            @if($blog->documents && $blog->documents->count() > 0)
                                <div class="tags mt-30">
                                    <ul class="tag-list">
                                        @foreach($blog->documents as $doc)
                                            @if($doc->media)
                                                <li>
                                                    <a href="{{ asset('storage/' . $doc->media->file_path) }}" target="_blank">
                                                        <i class="fa-solid fa-file-arrow-down"></i> {{ $doc->title ?: $doc->media->file_name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif



                            {{-- FAQ (if available) --}}
                            @if($blog->faqs && is_array($blog->faqs) && count($blog->faqs) > 0)
                                <div class="comments-area mt-50">
                                    <div class="section-heading">
                                        <h2 class="section-title">Frequently Asked Questions</h2>
                                    </div>
                                    @foreach($blog->faqs as $faq)
                                        @if(!empty($faq['question']))
                                            <div class="comment-item">
                                                <div class="comment-info">
                                                    <div class="comment-top">
                                                        <h3 class="author">{{ $faq['question'] }}</h3>
                                                    </div>
                                                    <p>{{ $faq['answer'] ?? '' }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ Blog Details -->
@endsection

@push('scripts')
<style>
    /* Custom Typography for Blog Content */
    .blog-details-content h1, 
    .blog-details-content h2, 
    .blog-details-content h3, 
    .blog-details-content h4, 
    .blog-details-content h5, 
    .blog-details-content h6 {
        color: #1e293b;
        font-weight: 500;
        margin-top: 1.8em;
        margin-bottom: 0.8em;
        line-height: 1.3;
        letter-spacing: -0.02em;
    }

    .blog-details-content h1 { font-size: 34px; }
    .blog-details-content h2 { font-size: 32px; }
    .blog-details-content h3 { font-size: 26px; }
    .blog-details-content h4 { font-size: 22px; }
    
    .blog-details-content p {
        font-size: 18px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 1.5em;
    }
    
    .blog-details-content ul, 
    .blog-details-content ol {
        font-size: 16px;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 1.5em;
        padding-left: 1.5em;
    }
    
    .blog-details-content li {
        margin-bottom: 0.5em;
    }
    
    .blog-details-content blockquote {
        border-left: 4px solid var(--primary, #3b82f6);
        padding-left: 20px;
        margin: 2em 0;
        font-size: 18px;
        font-style: italic;
        color: #334155;
        background: #f8fafc;
        padding: 20px;
        border-radius: 0 8px 8px 0;
    }
    
    .blog-details-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5em 0;
    }
</style>
@endpush
