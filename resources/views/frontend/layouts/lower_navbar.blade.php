      @php
          $generalSetting = App\Models\GeneralSetting::first();
          $categories = App\Models\Category::with('tests')->get();

      @endphp
      <div class="header-lower">
          <div class="auto-container">
              <div class="outer-box">
                  <div class="logo-box">
                      <figure class="logo"><a href="{{ route('home') }}"><img
                                  src="{{ asset(path: $generalSetting->logo) }}" alt="Asia_lab_logo" width="75" loading="lazy"></a>
                      </figure>
                  </div>
                  <div class="menu-area">
                      <!--Mobile Navigation Toggler-->
                      <div class="mobile-nav-toggler">
                          <i class="icon-bar"></i>
                          <i class="icon-bar"></i>
                          <i class="icon-bar"></i>
                      </div>
                      <nav class="main-menu navbar-expand-md navbar-light clearfix">
                          <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                              <ul class="navigation clearfix">
                                  <li><a href="{{ route('home') }}"
                                          class="{{ setActive(['home']) }}">{{ __('message.home') }}</a></li>
                                  <li><a href="{{ route('home.about') }}"
                                          class="{{ setActive(['home.about']) }}">{{ __('message.about Us') }}</a></li>

                                  <li class="dropdown">
                                      <a href="{{ route('home.service') }}"
                                          class="nav-link {{ setActive(['home.service','home.service.details']) }}">{{ __('message.service') }}</a>
                                      <ul class="dropdown-menu p-4 category-bg">
                                          <div class="row text-start">
                                              <!-- Column 1 -->
                                              <div class="row text-start">
                                                  @foreach ($categories as $category)
                                                      <div class="col-md-3 text-center category-col">
                                                          <h5 class="text-white fw-bolder">
                                                              <a href="{{ route('home.service.details',$category->id) }}"
                                                                  class="text-white mega-category">{{ $category->getTranslation('name', app()->getLocale()) }}</a>

                                                          </h5>
                                                          {{-- <ul class="list-unstyled">
                                                              @foreach ($category->tests as $test)
                                                                  <li>
                                                                      <a class="dropdown-item text-white"
                                                                          href="research.html">
                                                                          {{ $test->getTranslation('name', app()->getLocale()) }}
                                                                      </a>
                                                                  </li>
                                                              @endforeach
                                                          </ul> --}}
                                                      </div>
                                                  @endforeach
                                              </div>



                                              <!-- Add more columns... -->
                                          </div>
                                      </ul>
                                  </li>
                                  <li><a href="{{ route('home.gallery') }}"
                                          class="{{ setActive(['home.gallery']) }}">{{ __('message.gallery') }}</a>
                                  </li>
                                  <li><a href="{{ route('home.contact') }}"
                                          class="{{ setActive(['home.contact']) }}">{{ __('message.contact Us') }}</a>
                                  </li>
                              </ul>
                          </div>
                      </nav>
                  </div>
                  <div class="menu-right-content">
                      <div class="search-box-outer search-toggler mr_25">
                          <i class="icon-2"></i>
                      </div>
                      <select name="lang" class="lang-select form-control">
                          <option {{ app()->getLocale() == 'en' ? 'selected' : '' }} value="{{ url('locale/en') }}"
                              data-img="{{ asset('frontend/assets/images/en-us.svg') }}">
                              {{ __('message.en') }}
                          </option>
                          <option {{ app()->getLocale() == 'da' ? 'selected' : '' }} value="{{ url('locale/da') }}"
                              data-img="{{ asset('frontend/assets/images/afg.svg') }}">
                              {{ __('message.da') }}
                          </option>
                          <option {{ app()->getLocale() == 'pa' ? 'selected' : '' }} value="{{ url('locale/pa') }}"
                              data-img="{{ asset('frontend/assets/images/afg.svg') }}">
                                 {{ __('message.pa') }}
                          </option>
                      </select>
                  </div>

              </div>
          </div>
      </div>
