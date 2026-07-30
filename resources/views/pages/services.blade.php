@extends('layouts.master')

@section('title', 'Our Products - Possible Electrofeb LLP')
@section('meta_description', 'Explore our comprehensive range of high-performance electrical panels including LT PCC, LT MCC, APFC, Meter Panels, Solar ACDB/DCDB, and Cable Tray Systems.')
@section('meta_keywords', 'LT AC Combiner Panels, LT PCC Panels, LT MCC Panel, APFC Panel, Meter Panel, Solar ACDB DCDB Panel, Cable Tray System')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Products</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("services") }}'> Products</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="service-inner pt-130 pb-130">
            <div class="container container-2">
                <div class="row gy-5">
                    @foreach($globalProducts as $index => $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item-3 antra-hover-view">
                            <div class="service-thumb">
                                @if($product->cardMedia && $product->cardMedia->file_path)
                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}"><img src="{{ asset('storage/'.$product->cardMedia->file_path) }}" alt="{{ $product->name }}"></a>
                                @else
                                    @php
                                        $defaultImages = [
                                            asset('assets/img/service/service-img-1.png'),
                                            asset('assets/img/service/service-img-2.png'),
                                            asset('assets/img/service/service-img-3.png'),
                                            asset('assets/img/service/service-img-4.png'),
                                            asset('assets/img/Product Image/Meter_Panel.webp')
                                        ];
                                        $fallbackImg = $defaultImages[$index % count($defaultImages)];
                                    @endphp
                                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}"><img src="{{ $fallbackImg }}" alt="{{ $product->name }}"></a>
                                @endif
                                <span class="number">{{ sprintf('%02d', $index + 1) }}</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title"><a href="{{ route('product.single', ['slug' => $product->slug]) }}">{{ strtoupper($product->name) }}</a></h5>
                                <p>{{ $product->short_description ?? 'High-capacity electrical panels designed for robust power distribution and safety.' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ./ service-inner -->
@endsection
