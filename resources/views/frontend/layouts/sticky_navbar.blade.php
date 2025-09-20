                @php
                    $generalSetting = App\Models\GeneralSetting::first();
                @endphp
                <div class="sticky-header">
                    <div class="auto-container">
                        <div class="outer-box">
                            <div class="logo-box">
                                <figure class="logo"><a href="{{ route('home') }}"><img
                                            src="{{ asset(path: $generalSetting->logo) }}" alt="Asia_lab_logo" loading="lazy"
                                            width="75"></a>
                                </figure>
                            </div>
                            <div class="menu-area">
                                <nav class="main-menu clearfix">
                                    <!--Keep This Empty / Menu will come through Javascript-->
                                </nav>
                            </div>
                            <div class="menu-right-content">
                                <div class="search-box-outer search-toggler mr_25">
                                    <i class="icon-2"></i>
                                </div>
                                <select name="lang" class="lang-select form-control">
                                    <option {{ app()->getLocale() == 'en' ? 'selected' : '' }}
                                        value="{{ url('locale/en') }}"
                                        data-img="{{ asset('frontend/assets/images/en-us.svg') }}">
                                        English
                                    </option>
                                    <option {{ app()->getLocale() == 'da' ? 'selected' : '' }}
                                        value="{{ url('locale/da') }}"
                                        data-img="{{ asset('frontend/assets/images/afg.svg') }}">
                                        Dari
                                    </option>
                                    <option {{ app()->getLocale() == 'pa' ? 'selected' : '' }}
                                        value="{{ url('locale/pa') }}"
                                        data-img="{{ asset('frontend/assets/images/afg.svg') }}">
                                        Pashto
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
