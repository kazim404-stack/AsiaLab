@php
    $contact = App\Models\Contact::where('email', 'inf@asialab.af')
        ->with([
            'phones',
            'province' => function ($query) {
                $query->where('province', 'Herat master branch');
            },
        ])
        ->first();
    $generalSetting = App\Models\GeneralSetting::first();
    $categories = App\Models\Category::all();
    $chunks = $categories->chunk(ceil($categories->count() / 3));

@endphp
<footer class="main-footer">
    <div class="bg-layer" style="background-image: url({{ asset('frontend/assets/images/background/footer-bg.jpg') }});">
    </div>
    <div class="auto-container">
        <div class="footer-top">
            <div class="top-inner">
                <figure class="footer-logo"><img src="{{ asset($generalSetting->logo) }}" alt="asai_lab_logo"
                        width="100"></figure>
                <ul class="footer-menu">
                    <li><a href="{{ route('home') }}">{{ __('message.home') }}</a></li>
                    <li><a href="{{ route('home.about') }}">{{ __('message.about Us') }}</a></li>
                    <li><a href="{{ route('home.service') }}">{{ __('message.service') }}</a></li>
                    <li><a href="{{ route('home.gallery') }}">{{ __('message.gallery') }}</a></li>
                    <li><a href="{{ route('home.contact') }}">{{ __('message.contact Us') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="widget-section">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget about-widget">
                        <div class="widget-title">
                            <h3>{{ __('message.about Us') }}</h3>
                        </div>
                        <div class="widget-content">
                            <p>{{ __('message.slagon') }}</p>
                            <ul class="info clearfix">
                                <li><a href="mailto:info@example.com">{{ $contact->email }}</a></li>
                                @foreach ($contact->phones as $phone)
                                    <li><a href="tel:{{ $phone->phone_number }}"
                                            class="footer-phone">{{ $phone->phone_number }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                @foreach ($chunks as $chunk)
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h3>{{ __('message.service') }}</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    @foreach ($chunk as $category)
                                        <li>
                                            <a href="{{ route('home.service.details',$category->id) }}">
                                                {{ $category->getTranslation('name', app()->getLocale()) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="footer-bottom">
            <div class="bottom-inner">
                <div class="copyright">
                    @if (app()->getLocale() == 'en')
                        <p>Copyright &copy; @php echo date('y') @endphp <a href="{{ route('home') }}">AsiaLab</a>, All Rights
                            Reserved</p>
                    @elseif(app()->getLocale() == 'da')
                        <p>کپی‌رایت &copy; @php echo date('Y') @endphp <a href="{{ route('home') }}">آسیا لب</a>، تمامی حقوق
                          ddd  محفوظ است</p>
                    @else
                        <p>کاپي‌رایټ &copy; @php echo date('Y') @endphp <a href="{{ route('home') }}">آسیا لب</a>، ټول حقوق محفوظ
                            دي</p>
                    @endif
                </div>
                <ul class="social-links">
                    <li>
                        <h4>{{ __('message.follow us on') }}</h4>
                    </li>
                    @if ($generalSetting->facebook)
                        <li><a href="{{ $generalSetting->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if ($generalSetting->x)
                        <li><a href="{{ $generalSetting->x }}"><i class="fab fa-twitter"></i></a></li>
                    @endif
                    @if ($generalSetting->linkedin)
                        <li><a href="{{ $generalSetting->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                    @endif
                    @if ($generalSetting->instagram)
                        <li><a href="{{ $generalSetting->instagram }}"><i class="fab fa-instagram"></i></a></li>
                    @endif
                    @if ($generalSetting->whatsapp)
                        <li><a href="{{ $generalSetting->whatsapp }}"><i class="fab fa-whatsapp"></i></a></li>
                    @endif
                    @if ($generalSetting->telegram)
                        <li><a href="{{ $generalSetting->telegram }}"><i class="fab fa-telegram"></i></a></li>
                    @endif
                    @if ($generalSetting->youtube)
                        <li><a href="{{ $generalSetting->youtube }}"><i class="fab fa-youtube"></i></a></li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</footer>
