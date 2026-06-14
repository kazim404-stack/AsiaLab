@php
    use App\Models\Contact;


    $contacts = Contact::with('galleries')->get();
@endphp

@extends('frontend.layouts.front_master')

@section('about-links')
    <link href="{{ asset('frontend/assets/css/module-css/page-title.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/gallery.css') }}" rel="stylesheet">
@endsection

@section('homePage')
    <section class="gallery-section">
        <div class="auto-container">
            <div class="sec-title centred mb_70">
                <span class="sub-title mb_20">{{ __('message.gallery') }}</span>
                <h2>{{ __('message.view_our_gallery') }}</h2>
            </div>

            @if ($contacts && $contacts->count() > 0)
                <div class="sortable-masonry">

                    <div class="filters centred mb_50">
                        <ul class="filter-tabs filter-btns clearfix">
                            <li class="active filter" data-role="button" data-filter=".all">{{ __('message.all') }}</li>
                            @foreach ($contacts as $contact)
                                @if ($contact->galleries->count() > 0 || $contact->video_links)
                                    <li class="filter" data-role="button"
                                        data-filter=".{{ Str::slug($contact->getTranslation('state', app()->getLocale())) }}">
                                        {{ $contact->getTranslation('state', app()->getLocale()) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                    </div>

                    <div class="items-container row clearfix">
                        @foreach ($contacts as $contact)
                            @if ($contact->galleries->count() > 0 || $contact->video_links)

                                @foreach ($contact->galleries as $gallery)
                                    <div
                                        class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all
                    {{ Str::slug($contact->getTranslation('state', app()->getLocale())) }}">
                                        <div class="gallery-block-one">
                                            <div class="inner-box">
                                                <figure class="image-box">
                                                    <img src="{{ asset($gallery->image) }}"
                                                        alt="{{ $contact->getTranslation('state', app()->getLocale()) }}">
                                                </figure>
                                                <div class="view-btn">
                                                    <a href="{{ asset($gallery->image) }}" class="lightbox-image"
                                                        data-fancybox="gallery">
                                                        <i class="icon-63"></i>
                                                    </a>
                                                </div>
                                                <div class="text-box mt-3">
                                                    <h3 style="color: #fff !important;">
                                                        {{ $contact->getTranslation('state', app()->getLocale()) }}
                                                    </h3>
                                                    <p>{{ __('message.laboratory') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                @if ($contact->video_links)
                                    <div
                                        class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all
                    {{ Str::slug($contact->getTranslation('state', app()->getLocale())) }}">
                                        <div class="gallery-block-one h-100">
                                            <div class="inner-box h-100 position-relative">
                                                <figure class="image-box">
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#videoModal{{ $contact->id }}">
                                                        <img src="https://img.youtube.com/vi/{{ Str::after($contact->video_links, 'watch?v=') }}/hqdefault.jpg"
                                                            alt="Video thumbnail" class="img-fluid w-100 h-100"
                                                            style="object-fit:cover;">
                                                        <span class="play-btn">
                                                            <i class="fab fa-youtube fa-3x"></i>
                                                        </span>
                                                    </a>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <p>Gallery is empty ...</p>
            @endif
        </div>
    </section>

@endsection
