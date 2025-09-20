
@extends('frontend.layouts.front_master')
@section('service')
    <link href="{{ asset('frontend/assets/css/module-css/page-title.css') }}" rel="stylesheet">
@endsection
@section('homePage')
    <section class="page-title centred">
        <img class="bg-layer" src="{{ asset('frontend/assets/images/background/page-title-2.jpg') }}" alt="about-title-1"
            loading="eager" fetchpriority="high">
        <div class="overlay"></div>
        <img class="pattern-layer" src="{{ asset('frontend/assets/images/shape/shape-53.png') }}" alt="about-pattern-1"
            loading="eager" fetchpriority="high">
        <div class="auto-container">
            <div class="content-box">
                <h2>{{ __('message.our service') }}</h2>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                    <li>-</li>
                    <li>{{ __('message.service') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->
@endsection
{{-- @section('about-js-links')
    <script src="{{ asset('frontend/assets/js/particles.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/particles-config.js') }}"></script>
@endsection --}}
