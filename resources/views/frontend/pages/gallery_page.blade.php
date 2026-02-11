@php
    use App\Models\Gallery;

    $galleries = Gallery::all();
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
            @if($galleries && $galleries->count() > 0)

            <div class="sortable-masonry">
                <div class="filters centred mb_50">
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="active filter" data-role="button" data-filter=".all">{{ __('message.all') }}</li>
                        @foreach ($galleries->unique('branch_name') as $gallery)
                            <li class="filter" data-role="button"
                                data-filter=".{{ Str::slug($gallery->getTranslation('branch_name', app()->getLocale())) }}">
                                {{ $gallery->getTranslation('branch_name', app()->getLocale()) }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="items-container row clearfix">
                    @foreach ($galleries as $gallery)
                        <div
                            class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all {{ Str::slug($gallery->getTranslation('branch_name', app()->getLocale())) }}">
                            <div class="gallery-block-one">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="{{ asset($gallery->image) }}"
                                            alt="{{ $gallery->getTranslation('branch_name', app()->getLocale()) }}">
                                    </figure>
                                    <figure class="overlay-image">
                                        <img src="{{ asset( $gallery->image) }}"
                                            alt="{{ $gallery->getTranslation('branch_name', app()->getLocale()) }}">
                                    </figure>
                                    <div class="view-btn">
                                        <a href="{{ asset(  $gallery->image) }}"
                                            class="lightbox-image" data-fancybox="gallery">
                                            <i class="icon-63"></i>
                                        </a>
                                    </div>
                                    <div class="text-box">
                                        <h3 style="color: #fff !important;">{{ $gallery->getTranslation('branch_name', app()->getLocale()) }}</h3>
                                        <p>{{ __('message.laboratory') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <p>Gallery is empty ...</p>
            @endif
        </div>
    </section>
@endsection
