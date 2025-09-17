@extends('frontend.layouts.front_master')
@section('about-links')
    <link href="{{ asset('frontend/assets/css/module-css/page-title.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/testimonial.css') }}" rel="stylesheet">
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
                <h2>{{ __('message.about Us') }}</h2>
                <ul class="bread-crumb">
                    <li><a href="index.html">{{ __('message.home') }}</a></li>
                    <li>-</li>
                    <li>{{ __('message.about Us') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->
@endsection
@section('about-js-links')
    <script src="{{ asset('frontend/assets/js/particles.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/particles-config.js') }}"></script>
@endsection
