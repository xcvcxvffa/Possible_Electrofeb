@extends('layouts.master')

@section('title', 'Project Details - Antra Architecture & Interior Design')
@section('meta_description', 'Detailed view of our featured architectural and interior design project.')
@section('meta_keywords', 'project detail, stylish apartment, open living space, modern amenities')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Project details</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("projects") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("project.detail") }}'> Project Details</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header --> 
            
        <section class="portfolio-details pt-130 pb-130">
            <div class="container container-2">
                <div class="project-details-wrap">
                    <h1 class="details-title">Stylish Family Appartment</h1>
                    <div class="project-details-meta">
                        <div class="details-meta">
                            <span>Architect :</span>
                            <h5>David Oswald</h5>
                        </div>
                        <div class="details-meta">
                            <span>project type:</span>
                            <h5>Interior Design</h5>
                        </div>
                        <div class="details-meta">
                            <span>client:</span>
                            <h5>antraThemes</h5>
                        </div>
                        <div class="details-meta">
                            <span>Terms:</span>
                            <h5>6 month</h5>
                        </div>
                        <div class="details-meta">
                            <span>Strategy :</span>
                            <h5>Minimalistic</h5>
                        </div>
                        <div class="details-meta">
                            <span>Date :</span>
                            <h5>March 11, 2025</h5>
                        </div>
                    </div>
                    <div class="project-details-img">
                        <img src="{{ asset('assets/img/project/project-details-img-1.png') }}" alt="img">
                    </div>
                    <h2 class="details-title-2">Design in Details</h2>
                    <p>Considering the physical, mental, and emotional needs of people, interior designers use human-centered approaches to address how we live today. Creating novel approaches to promoting health, safety, and welfare, contemporary interiors are increasingly inspired by biophilia as a holistic approach to design.</p>
                    <div class="project-details-list">
                        <ul>
                            <li><i class="fa-sharp fa-solid fa-circle-check"></i><strong>Open Living Spaces:</strong> Creating open-plan living areas to enhance the flow and connection between indoor and outdoor spaces.</li>
                            <li><i class="fa-sharp fa-solid fa-circle-check"></i><strong>Natural Materials:</strong> Using reclaimed wood, stone, and natural fibers to evoke a sense of harmony with the surrounding environment.</li>
                        </ul>
                    </div>
                    <div class="project-details-items">
                        <div class="project-details-item text-center">
                            <h3 class="title">(30m2)</h3>
                            <span>bedroom</span>
                        </div>
                        <div class="project-details-item text-center">
                            <h3 class="title">(22m2)</h3>
                            <span>bathroom</span>
                        </div>
                        <div class="project-details-item text-center">
                            <h3 class="title">(28m2)</h3>
                            <span>workspace</span>
                        </div>
                        <div class="project-details-item text-center">
                            <h3 class="title">(15m2)</h3>
                            <span>kitchen area</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
