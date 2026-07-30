@extends('layouts.master')

@section('title', ($product->meta_title ?? $product->name) . ' - Product Details | Possible Electrofeb LLP')
@section('meta_description', $product->meta_description ?? $product->short_description)

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">{{ $product->name }}</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("products") }}'> Products</a><span class="icon">-</span><span class="inner-page"> {{ $product->name }}</span></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="service-details pt-130 pb-130">
            <div class="container container-2">
                <div class="row pin-inner">
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                        <div class="service-details-left-content pin-box mb-0">
                            <div class="service-category-list mb-0">
                                <h3 class="list-title">Our Products</h3>
                                <ul>
                                    @foreach($globalProducts as $sp)
                                        <li class="{{ $product->id == $sp->id ? 'active' : '' }}"><a href="{{ route('product.single', ['slug' => $sp->slug]) }}">{{ strtoupper($sp->name) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="service-details-content scroll-content">
                            <div class="service-details-img overflow-hidden shadow-sm" style="border-radius: 20px;">
                                @if($product->bannerMedia)
                                    <img src="{{ asset('storage/' . $product->bannerMedia->file_path) }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 20px; object-fit: cover;">
                                @elseif($product->cardMedia)
                                    <img src="{{ asset('storage/' . $product->cardMedia->file_path) }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 20px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/service/service-details-img-1.png') }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 20px; object-fit: cover;">
                                @endif
                            </div>
                            
                            <h1 class="details-title mt-4" style="color: #0097A0; font-weight: 500; letter-spacing: 0.5px;">{{ $product->name }}</h1>
                            <div class="fs-6 mb-4" style="line-height: 1.8; color: #4a4a4a;">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                            
                            @if($product->features->count() > 0 || $product->applications->count() > 0)
                            <!-- Key Features & Applications Grid -->
                            <div class="row gy-4 my-4">
                                @if($product->features->count() > 0)
                                <div class="col-md-6">
                                    <div class="p-0 rounded-4 bg-white shadow-sm h-100 overflow-hidden border">
                                        <div class="px-4 py-3 text-white fw-bold" style="background: #0097A0; font-size: 16px; letter-spacing: 0.5px;">
                                            <span>KEY FEATURES :</span>
                                        </div>
                                        <div class="p-4">
                                            <ul class="list-unstyled mb-0" style="font-size: 14.5px; color: #333333; line-height: 1.8;">
                                                @foreach($product->features as $feature)
                                                    <li class="mb-3 d-flex align-items-start gap-2">
                                                        <i class="fa-solid fa-circle-check mt-1" style="color: #0097A0;"></i> 
                                                        <span>{{ $feature->feature_text }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                @if($product->applications->count() > 0)
                                <div class="col-md-6">
                                    <div class="p-0 rounded-4 bg-white shadow-sm h-100 overflow-hidden border">
                                        <div class="px-4 py-3 text-white fw-bold" style="background: #0097A0; font-size: 16px; letter-spacing: 0.5px;">
                                            <span>APPLICATIONS :</span>
                                        </div>
                                        <div class="p-4">
                                            <ul class="list-unstyled mb-0" style="font-size: 14.5px; color: #333333; line-height: 1.8;">
                                                @foreach($product->applications as $app)
                                                    <li class="mb-3 d-flex align-items-start gap-2">
                                                        <i class="fa-solid fa-circle-arrow-right mt-1" style="color: #0097A0;"></i> 
                                                        <span>{{ $app->application_text }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Technical Details Section -->
                            @if($product->specifications->count() > 0)
                            <div class="my-4">
                                <div class="rounded-4 overflow-hidden shadow-sm border bg-white" style="border-color: #e2e8f0 !important;">
                                    <div class="px-4 py-3 text-white fw-bold" style="background: #0097A0; font-size: 16px; letter-spacing: 0.5px;">
                                        <span class="text-uppercase">TECHNICAL DETAILS :</span>
                                    </div>
                                    
                                    <div class="tech-spec-list">
                                        @foreach($product->specifications as $spec)
                                            <div class="d-flex align-items-center px-4 py-3 tech-spec-item" style="background-color: {{ $loop->odd ? '#f7fafc' : '#ffffff' }}; {{ !$loop->last ? 'border-bottom: 1px solid #edf2f7;' : '' }}">
                                                <div class="spec-label" style="width: 44%; font-weight: 700; color: #1a202c; font-size: 14.5px;">{{ rtrim($spec->spec_label, ' :') }} :</div>
                                                <div class="spec-value" style="width: 56%; color: #4a5568; font-weight: 500; font-size: 14.5px;">{{ $spec->spec_value }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Removed old Gallery and Documents sections to match new schema -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ service-details -->
@endsection
