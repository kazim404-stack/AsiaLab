@php
    $sliders = App\Models\Slider::with('sliderImages')->where('status', 1)->get();
@endphp

<section class="banner-section p_relative">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none owl-nav-none">
        @foreach ($sliders as $slider)
            <div class="slide-item p_relative">

                @foreach ($slider->sliderImages as $image)
                    <img src="{{ asset($image->image) }}" alt="Space Physics Research Laboratory Banner" class="bg-layer"
                        loading="eager" fetchpriority="high" />
                @endforeach

                <img src="{{ asset('frontend/assets/images/shape/shape-1.png') }}" alt="shape-1" class="pattern-layer"
                    aria-hidden="true" loading="eager" fetchpriority="high" />



                <div class="auto-container">
                    <div class="content-box p_relative d_block z_5">
                        <span class="sub-title">{{ __('message.laboratory') }}</span>
                        <h2>{{ $slider->getTranslation('title', app()->getLocale()) }}</span></h2>
                        <p>{{ $slider->getTranslation('description', app()->getLocale()) }}</p>
                        <div class="btn-box">
                            <a href="{{ route('home.contact') }}" class="theme-btn">{{ __('message.contact Us') }}
                                <span></span><span></span><span></span><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
