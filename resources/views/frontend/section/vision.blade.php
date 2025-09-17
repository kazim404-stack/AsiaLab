        @php
            $vision = App\Models\AboutUs::with('aboutImages')->where('type','vision')->first();
        @endphp
        <section class="about-style-two pt_20 pb_20">
            <div class="pattern-layer">
                <div class="pattern-2" style="background-image: url(frontend/assets/images/shape/shape-14.png);"></div>
            </div>
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_one">
                            <div class="content-box mt_25 mr_70 sec-title-animation animation-style2">
                                <div class="sec-title mb_25">
                                    <h2 class="title-animation">{{ $vision->getTranslation('title',app()->getLocale()) }}</h2>
                                </div>
                                <div class="text-box mb_45 title-animation">
                                    <p class="text-justify">{{ $vision->getTranslation('description',app()->getLocale()) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image_block_two d-flex justify-content-center">
                            <div class="image-inner">
                                <div class="row clearfix">
                                    <div
                                        class="col-lg-12 col-md-12 col-sm-12 single-column d-flex justify-content-center">
                                        <figure class="image pt_100 mt_15">
                                            @if($vision && $vision->aboutImages()->count() > 0)
                                            @foreach ($vision->aboutImages as $image)
                                            <img src="{{ asset($image->image) }}" alt="vision-image" loading="lazy">
                                            @endforeach
                                            @endif
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
