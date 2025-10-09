@php
    $generalSettings = App\Models\GeneralSetting::with([
        'contacts' => function ($query) {
            return $query->where('status', 1)->with('phones', 'province');
        },
    ])->get();
@endphp
@extends('frontend.layouts.front_master')
@section('contact')
    <link href="{{ asset('frontend/assets/css/module-css/page-title.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/contact.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection
@section('homePage')
    <section class="page-title centred">
        <img class="bg-layer" src="{{ asset('frontend/assets/images/background/page-title-5.jpg') }}" alt="about-title-1"
            loading="eager" fetchpriority="high">
        <div class="overlay"></div>
        <img class="pattern-layer" src="{{ asset('frontend/assets/images/shape/shape-53.png') }}" alt="about-title-2"
            loading="eager" fetchpriority="high">
        <div class="auto-container">
            <div class="content-box">
                <h2>{{ __('message.contact Us') }}</h2>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                    <li>-</li>
                    <li>{{ __('message.contact Us') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->

    <!-- contact-info-section -->
    <section class="contact-info-section pt_120 pb_90 centred">
        <div class="auto-container">
            <div class="sec-title mb_70 sec-title-animation animation-style2">
                <span class="sub-title mb_20 title-animation">{{ __('message.contact_info') }}</span>
                <h2 class="title-animation">{{ __('message.our_contact_details') }}</h2>
            </div>
            <div class="auto-container">
                <div class="branch-section py-5 bg-light">
                    <div class="container">
                        <div class="section-title text-center mb-5">
                            <h2 class="fw-bold">{{ __('message.our_branches') }}</h2>
                            <p class="text-muted">{{ __('message.find_offices_near_you') }}</p>
                        </div>
                        <div class="row g-4">

                            <!-- Branch 1 -->
                            @foreach ($generalSettings as $generalSetting)
                                @foreach ($generalSetting->contacts as $contact)
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card h-100 shadow-sm border-0">
                                            <div class="card-body text-center p-4">
                                                <div class="mb-3">
                                                    <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                                                </div>
                                                <h5 class="card-title fw-bold">{{ $contact->province->province }}</h5>
                                                @foreach ($contact->phones as $phone)
                                                    @if (app()->getLocale() == 'en')
                                                        <p class="card-text mb-2">
                                                            <a href="https://wa.me/{{ $phone->phone_number }}"><i
                                                                    class="fab fa-whatsapp me-2 text-success fa-lg"></i><span
                                                                    class="text-black">{{ $phone->phone_number }}</span></a>
                                                        </p>

                                                        {{-- @if ($contact->phones->count() == 1)

                                                            <a href="https://wa.me/{{ $phone->phone_number }}"
                                                                target="_blank">
                                                                <i class="fab fa-whatsapp text-success fa-3x ms-2"></i>
                                                            </a>
                                                        @elseif ($contact->phones->count() > 1 && $loop->last)
                                                            <a href="https://wa.me/{{ $phone->phone_number }}"
                                                                target="_blank">
                                                                <i class="fab fa-whatsapp text-success fa-3x ms-2"></i>
                                                            </a>
                                                        @endif --}}
                                                    @else
                                                        <p class="card-text mb-2">
                                                            <a href="https://wa.me/{{ $phone->phone_number }}"><i
                                                                    class="fab fa-whatsapp me-2 text-success fa-lg"></i><span
                                                                    class="text-black">&lrm;{{ $phone->phone_number }}</span></a>
                                                        </p>
                                                    @endif
                                                @endforeach

                                                <p class="card-text mb-2"><i class="fas fa-envelope me-2 text-primary"></i>
                                                    {{ $contact->email }}</p>
                                                <p class="card-text"><i class="fas fa-location-dot me-2 text-danger"></i>
                                                    {{ $contact->getTranslation('address', app()->getLocale()) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- contact-section -->
    <section class="contact-section  pb_180">
        <div class="auto-container">
            <div class="sec-title centred mb_70 sec-title-animation animation-style2">
                <span class="sub-title mb_20 title-animation">{{ __('message.send_message') }}</span>
                <h2 class="title-animation">{{ __('message.get_in_touch') }}</h2>
            </div>
            <div class="form-inner">
                <form method="post" id="contact-form" action="{{ route('home.send.contact') }}">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label for="message" class="text-white">*</label>
                            <input type="text" name="name" id="name"
                                placeholder="{{ __('message.your_name') }}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label for="email" class="text-danger">*</label>
                            <input type="email" name="email" id="email"
                                @if (app()->getLocale() == 'da' || app()->getLocale() == 'pa') style="text-align: right !important;" @endif
                                placeholder="{{ __('message.Your_email') }}" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label for="message" class="text-white">*</label>
                            <input type="text" name="phone" id="phone" placeholder="{{ __('message.phone') }}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <label for="subject" class="text-danger">*</label>
                            <input type="text" name="subject" id="subject" placeholder="{{ __('message.subject') }}"
                                required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="message" class="text-danger">*</label>
                            <textarea name="message" id="message" placeholder="{{ __('message.your_message') }}" required></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn centred">

                            <button class="btn btn-success btn-lg" type="submit" id="contact-send-btn">
                                <span id="contact-btn-text">{{ __('message.ask_question') }}</span>
                                <span id="contact-ajax-loading-btn" class="d-none">
                                    <span>{{ __('message.sending') }}</span>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </span>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- contact-section end -->
    <!-- contact-info-section end -->



    <section class="google-map-section">
        <div class="container-fluid">
            <div class="map-inner">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </section>
    <!-- google-map-section end -->
@endsection
@section('contact-js')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('frontend/assets/js/contact.js') }}"></script>
@endsection
