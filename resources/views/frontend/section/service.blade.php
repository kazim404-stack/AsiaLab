    @php
        $categories = App\Models\Category::where('status', 1)->get();
    @endphp
    <section class="service-section pt_120 pb_90">
        <div class="bg-layer parallax-bg" data-parallax='{"y": 100}'
            style="background-image: url({{ asset('frontend/assets/images/background/service-bg.jpg') }});"></div>
        <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-8.png') }});">
        </div>
        <div class="auto-container">
            <div class="sec-title centred mb_70 sec-title-animation animation-style2">
                <span class="sub-title mb_20 title-animation">{{ __('message.our service') }}</span>
                <h2 class="title-animation">{{ __('message.we provide reliable services') }}</h2>
            </div>
            <div class="row clearfix">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                        <div class="service-block-one">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class='r-hex'>
                                        <div class='r-hex-inner'></div>
                                    </div>
                                    <div class="icon">{!! $category->fa_icon !!}</div>
                                </div>
                                <h3><a
                                        href="{{ route('home.service.details', $category->id) }}">{{ $category->getTranslation('name', app()->getLocale()) }}</a>
                                </h3>
                                <p class="text-jsutify">{!! $category->getTranslation('description', app()->getLocale()) !!}</p>
                                <div class="link"><a
                                        href="{{ route('home.service.details', $category->id) }}">{{ __('message.Discover More') }}<i
                                            class="fal fa-angle-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
