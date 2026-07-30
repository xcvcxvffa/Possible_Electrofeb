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
                    <h4 class="sub-title"><a class='home' href='{{ route("home") }}'>Home </a><span class="icon">-</span><a class='inner-page' href='{{ route("products") }}'> Products</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="service-inner pt-130 pb-130">
            <div class="container container-2">
                <div class="row gy-5">
                    @forelse($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="service-item-3 antra-hover-view d-block text-decoration-none h-100" style="cursor: pointer;">
                            <div class="service-thumb">
                                @if($product->cardMedia)
                                    <img src="{{ asset('storage/' . $product->cardMedia->file_path) }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('assets/img/service/service-img-1.png') }}" alt="{{ $product->name }}">
                                @endif
                                <span class="number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="service-content">
                                <h5 class="title">{{ $product->name }}</h5>
                                <p>{{ Str::limit($product->short_description, 90) }}</p>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <h4>No products found.</h4>
                    </div>
                    @endforelse
                </div>
                
                @if($products->hasPages())
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- ./ service-inner -->
@endsection
