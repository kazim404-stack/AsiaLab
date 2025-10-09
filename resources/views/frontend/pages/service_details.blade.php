@extends('frontend.layouts.front_master')
@section('about-links')
    <link href="{{ asset('frontend/assets/css/module-css/page-title.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/service-details.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/service-sidebar.css') }}" rel="stylesheet">
@endsection
@section('homePage')

    <section class="page-title centred">
        <img class="bg-layer" src="{{ asset('frontend/assets/images/background/page-title-2.jpg') }}" alt="about-title-1"
            loading="eager" fetchpriority="high">
        <div class="overlay"></div>
        <img class="pattern-layer" src="{{ asset('frontend/assets/images/shape/shape-53.png') }}" alt="about-title-2"
            loading="eager" fetchpriority="high">
        <div class="auto-container">
            <div class="content-box">
                <h2>{{ $category->getTranslation('name', app()->getLocale()) }}</h2>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                    <li>-</li>
                    <li>{{ __('message.services_details') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->
    <!-- service-details -->
    <section class="service-details">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar mr_20">
                        <div class="category-widget sidebar-widget mb_30">
                            <div class="widget-title mb_12">
                                <h3>{{ __('message.our service') }}</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list clearfix nav flex-column" id="serviceTab" role="tablist">
                                    @if ($category->tests)
                                        @foreach ($category->tests as $index => $test)
                                            @php
                                                $slug = Str::slug($test->getTranslation('name', app()->getLocale()));
                                            @endphp
                                            <li>
                                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                    id="tab-{{ $slug }}" data-bs-toggle="tab"
                                                    data-bs-target="#content-{{ $slug }}" role="tab">
                                                    {{ $test->getTranslation('name', app()->getLocale()) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content tab-content" id="serviceTabContent">
                        @foreach ($category->tests as $index => $test)
                            @php
                                $slug = Str::slug($test->getTranslation('name', app()->getLocale()));
                            @endphp
                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                id="content-{{ $slug }}" role="tabpanel">
                                <div class="text-box mb_35">
                                    <h2>{{ $test->getTranslation('name', app()->getLocale()) }}</h2>
                                    <p class="text-justify">{!! $test->getTranslation('description', app()->getLocale()) !!}</p>
                                </div>
                                @foreach ($test->testImages as $image)
                                    <figure class="image-box mb_35">
                                        <img src="{{ asset($image->image) }}" alt="test-image-{{ $image->id }}"
                                            loading="lazy" width="850" height="500">
                                    </figure>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-details end -->
@endsection

