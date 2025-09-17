        @php
            $generalSetting = App\Models\GeneralSetting::first();
        @endphp
        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner">
                    @if (app()->getLocale() == 'en')
                        <p><i class="icon-1"></i>Open Hours: Sat - Thur 8.00 am - 5.00 pm</p>
                    @elseif (app()->getLocale() == 'da')
                        <p><i class="icon-1"></i>ساعات کاری: شنبه تا پنجشنبه ۸:۰۰ صبح - ۵:۰۰ عصر</p>
                    @else
                        <p><i class="icon-1"></i>د کار وختونه: شنبه تر پنجشنبې ۸:۰۰ سهار - ۵:۰۰ ماښام</p>
                    @endif
                    <ul class="social-links">
                        <li><span>{{ __('message.on social') }}:</span></li>
                        @if ($generalSetting->facebook)
                            <li><a href="{{ $generalSetting->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if ($generalSetting->x)
                            <li><a href="{{ $generalSetting->x }}"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        {{-- @if ($generalSetting->linkedin)
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
                        @endif --}}
                    </ul>
                </div>
            </div>
        </div>
