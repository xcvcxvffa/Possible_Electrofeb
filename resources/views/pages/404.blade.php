@extends('layouts.master')

@section('title', '404 Not Found - ' . config('app.name'))

@section('content')
<section class="page-header">
    <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
    <div class="overlay"></div>
    <div class="container">
        <div class="page-header-content">
            <h1 class="title">404</h1>
            <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='#'> 404</a></h4>
        </div>
    </div>
</section>
<!-- ./ page-header -->

<section class="error-section pt-100 pb-100 text-center" style="min-height: 40vh; display: flex; align-items: center; justify-content: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-1 fw-bold mb-3" style="font-size: 8rem; letter-spacing: -5px; color: var(--tl-color-theme-primary);">404</h1>
                <h3 class="fw-bold mb-4">Oops! Page Not Found</h3>
                <p class="text-muted fs-18 mb-5">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                <a href="{{ route('home') }}" class="tl-primary-btn">Back to Homepage <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
            </div>
        </div>
    </div>
</section>
@endsection
