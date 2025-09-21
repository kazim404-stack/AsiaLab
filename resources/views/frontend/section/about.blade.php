@php
    $about = App\Models\AboutUs::where('type', 'about')->first();
    $firstImage = $about->aboutImages->get(0);
    $secondImage = $about->aboutImages->get(1);
@endphp
<!-- about-style-two -->
<section class="about-style-two pt_120 pb_120">
    <div class="pattern-layer">
        <div class="pattern-2" style="background-image: url(frontend/assets/images/shape/shape-14.png);"></div>
    </div>
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_one">
                    <div class="content-box mt_25 mr_70 sec-title-animation animation-style2">
                        <div class="sec-title mb_25">
                            <span class="sub-title mb_20 title-animation">{{ __('message.laboratory') }}</span>
                            <h2 class="title-animation">{{ $about->getTranslation('title', app()->getLocale()) }}</h2>
                        </div>
                        <div class="text-box mb_45 title-animation">
                            <p class="text-justify">{{ $about->getTranslation('description', app()->getLocale()) }}</p>

                            <ul class="list-style-one clearfix">
                                <li>{{ __('message.about_1') }}</li>
                                <li>{{ __('message.about_2') }}</li>
                            </ul>
                        </div>
                        <div class="btn-box">
                            <a href="{{ route('home.contact') }}" class="theme-btn">{{__('message.contact Us')}}<span></span><span></span><span></span><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div class="image_block_two" style="margin-top: 162px !important;">
                    <div class="image-inner">
                        <div class="image-shape">
                            <img class="shape-1" src="{{ asset('frontend/assets/images/shape/shape-12.png') }}"
                                alt="about-shape-1" loading="lazy">
                            <img class="shape-2" src="{{ asset('frontend/assets/images/shape/shape-12.png') }}"
                                alt="about-shap-2" loading="lazy">
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="image-box">
                                    @if ($firstImage)
                                        <figure class="image mb_30">
                                            <img src="{{ asset($firstImage->image) }}" alt="about-image-1" loading="lazy">
                                        </figure>
                                    @endif

                                    <div class="experience-box bounce-slide">
                                        <div class="inner p_relative pt_5 pb_5">
                                            <h2>8 <span>Years</span></h2>
                                            <h3>Of Experience in the laboratory tests</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">

                                @if ($secondImage)
                                    <figure class="image mb_30">
                                        <img src="{{ asset($secondImage->image) }}" alt="about-image-2" loading="lazy">
                                    </figure>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-style-two end -->
