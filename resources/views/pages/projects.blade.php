@extends('layouts.master')

@section('title', 'Our Projects - Antra Architecture & Interior Design')
@section('meta_description', 'Explore our portfolio of innovative architectural and interior design projects crafted with precision.')
@section('meta_keywords', 'architecture portfolio, interior projects, residential design, commercial interiors')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Our Projects</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("projects") }}'> Projects</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->    
        
        <section class="project-section-inner pt-130 pb-130">
            <div class="container container-2">
                <div class="row gy-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item antra-hover-view">
                            <div class="project-img">
                                <a class="d-block p-relative z-1" href="{{ route('project.detail') }}"><img src="{{ asset('assets/img/project/project-img-1.png') }}" alt="project"></a>
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                            </div>
                            <div class="project-content">
                                <h3 class="title"><a href="{{ route('project.detail') }}">Luxury Skyline</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item antra-hover-view">
                            <div class="project-img">
                                <a class="d-block p-relative z-1" href="{{ route('project.detail') }}"><img src="{{ asset('assets/img/project/project-img-2.png') }}" alt="project"></a>
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                            </div>
                            <div class="project-content">
                                <h3 class="title"><a href="{{ route('project.detail') }}">Bohemian Rhapsody</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item antra-hover-view">
                            <div class="project-img">
                                <a class="d-block p-relative z-1" href="{{ route('project.detail') }}"><img src="{{ asset('assets/img/project/project-img-3.png') }}" alt="project"></a>
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                            </div>
                            <div class="project-content">
                                <h3 class="title"><a href="{{ route('project.detail') }}">Vintage Glamour</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item antra-hover-view">
                            <div class="project-img">
                                <a class="d-block p-relative z-1" href="{{ route('project.detail') }}"><img src="{{ asset('assets/img/project/project-img-4.png') }}" alt="project"></a>
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Commercial</a></li>
                                    <li><a href="{{ route('project.detail') }}">Office Interior</a></li>
                                </ul>
                            </div>
                            <div class="project-content">
                                <h3 class="title"><a href="{{ route('project.detail') }}">Titan Office Interior</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item antra-hover-view">
                            <div class="project-img">
                                <a class="d-block p-relative z-1" href="{{ route('project.detail') }}"><img src="{{ asset('assets/img/project/project-img-5.png') }}" alt="project"></a>
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Modern Villa</a></li>
                                </ul>
                            </div>
                            <div class="project-content">
                                <h3 class="title"><a href="{{ route('project.detail') }}">Living Innovation</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
