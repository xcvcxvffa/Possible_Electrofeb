@extends('layouts.master')

@section('title', 'Portfolio Style 2 - Antra')

@section('content')
<div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Our Projects</h1>
                    <h4 class="sub-title"><a class='home' href='service.html'>Home </a><span class="icon">-</span><a class='inner-page' href='about.html'> Projects</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->    
        
        <section class="project-section-inner pt-130 pb-130">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item-3">
                            <div class="project-img">
                                <img src="{{ asset('assets/img/project/project-3.png') }}" alt="project">
                            </div>
                            <div class="project-content">
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                                <h3 class="title"><a href="{{ route('project.detail') }}">Coastal Harmony Home</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item-3">
                            <div class="project-img">
                                <img src="{{ asset('assets/img/project/project-4.png') }}" alt="project">
                            </div>
                            <div class="project-content">
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                                <h3 class="title"><a href="{{ route('project.detail') }}">Coastal Harmony Home</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item-3">
                            <div class="project-img">
                                <img src="{{ asset('assets/img/project/project-5.png') }}" alt="project">
                            </div>
                            <div class="project-content">
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                                <h3 class="title"><a href="{{ route('project.detail') }}">Coastal Harmony Home</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item-3">
                            <div class="project-img">
                                <img src="{{ asset('assets/img/project/project-6.png') }}" alt="project">
                            </div>
                            <div class="project-content">
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                                <h3 class="title"><a href="{{ route('project.detail') }}">Coastal Harmony Home</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item-3">
                            <div class="project-img">
                                <img src="{{ asset('assets/img/project/project-7.png') }}" alt="project">
                            </div>
                            <div class="project-content">
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                                <h3 class="title"><a href="{{ route('project.detail') }}">Coastal Harmony Home</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item-3">
                            <div class="project-img">
                                <img src="{{ asset('assets/img/project/project-8.png') }}" alt="project">
                            </div>
                            <div class="project-content">
                                <ul>
                                    <li><a href="{{ route('project.detail') }}">Residential</a></li>
                                    <li><a href="{{ route('project.detail') }}">Single Home</a></li>
                                </ul>
                                <h3 class="title"><a href="{{ route('project.detail') }}">Coastal Harmony Home</a></h3>
                                <span>Berlin, Germany <br>2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ project-section -->
@endsection

