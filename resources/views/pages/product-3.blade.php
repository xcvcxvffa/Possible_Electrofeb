@extends('layouts.master')

@section('title', 'Product Style 3 - Possible Electrofeb LLP')

@section('content')
        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Products</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("products") }}'> Products</a></h4>
                </div>
            </div>
        </section>

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
@endsection
