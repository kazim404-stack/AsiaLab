@php
    $galleries = App\Models\Photo::where('type', 'gallery')->get();
@endphp
@extends('frontend.layouts.front_master')
@section('about-links')
    <link href="{{ asset('frontend/assets/css/module-css/page-title.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/gallery.css') }}" rel="stylesheet">
@endsection
@section('homePage')
    <!-- main-content -->
    <!-- page-title -->
    <section class="page-title centred">

        <img class="bg-layer" src="{{ asset('frontend/assets/images/background/page-title-5.jpg') }}" alt="about-title-1"
            loading="eager" fetchpriority="high">
        <div class="overlay"></div>
        <img class="pattern-layer" src="{{ asset('frontend/assets/images/shape/shape-53.png') }}" alt="about-title-1"
            loading="eager" fetchpriority="high">
        <div class="auto-container">
            <div class="content-box">
                <h2>{{ __('message.image_gallery') }}</h2>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                    <li>-</li>
                    <li>{{ __('message.gallery') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->
    {{-- Gallery start --}}
    <section class="gallery-section">
        <div class="auto-container">
            <div class="sec-title centred mb_70 sec-title-animation animation-style2">
                <span class="sub-title mb_20 title-animation">{{ __('message.gallery') }}</span>
                <h2 class="title-animation">{{ __('message.view_our_gallery') }}</h2>
            </div>
            <div class="sortable-masonry">
                <div class="items-container row clearfix">
                    @foreach ($galleries as $gallery)
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all science chemistry material">
                            <div class="gallery-block-one">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{ asset($gallery->image) }}" loading="lazy" alt="image-box-{{ $gallery->id }}">
                                    </figure>
                                    <figure class="overlay-image"><img src="{{ asset($gallery->image) }}" loading="lazy" alt="overlay-image-{{ $gallery->id }}">
                                    </figure>
                                    <div class="view-btn"><a href="{{ asset($gallery->image) }}" class="lightbox-image"
                                            data-fancybox="gallery"><i class="icon-63"></i></a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
