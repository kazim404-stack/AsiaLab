<!DOCTYPE html>
<html
    @if (app()->getLocale() == 'en') lang="en" dir="ltr" @elseif (app()->getLocale() == 'pa') lang="fa" dir="rtl" @else lang="ps" dir="rtl" @endif>
<!--
+--------------------------------------------------------------------------------------+
|                               Developed by:                                          |
+-------------------------------------+------------------------------------------------+
| Kazim Mohammadi (kazimmohammadi404@gmail.com) | Mahdy Ataey (ataey.2012@gmail.com)   |                               |
+-------------------------------------+------------------------------------------------+
!-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="I-MaQSF-htVobr5642B-ESD8EpAh1jcVN4bI1zhcKJM" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Meta Description -->
    <meta name="description" lang="en"
        content="Asia Lab is a trusted medical laboratory offering advanced services such as Histology, Hematology, Pathology, PCR, Microbiology, Virology, Immunology, and more.">

    <!-- Meta Keywords -->
    <meta name="keywords" lang="en"
        content="Asia Lab, medical laboratory, diagnostic center, histology, hematology, PCR test, microbiology">

    <title>Asia Lab</title>
    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('backend/assets/images/favoicon.webp') }}" type="image/webp" />
    <!-- Google Fonts -->
    @if (app()->getLocale() == 'en')
        <!-- Preconnect to improve loading -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Preload -->
        <link rel="preload" as="style"
            href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap">
        <link rel="preload" as="style"
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap">

        <!-- Async load -->
        <link
            href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" media="print" onload="this.media='all'">
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet" media="print" onload="this.media='all'">
    @endif

    @if (app()->getLocale() == 'da')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link rel="preload" as="style"
            href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap">

        <link
            href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet" media="print" onload="this.media='all'">
    @endif

    @if (app()->getLocale() == 'pa')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link rel="preload" as="style"
            href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap">

        <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap"
            rel="stylesheet" media="print" onload="this.media='all'">
    @endif



    <!-- Stylesheets -->

    <!-- Stylesheets -->
    <link rel="preload" as="style" href="{{ asset('frontend/assets/css/font-awesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome-all.css') }}" media="print"
        onload="this.media='all'">
    <link rel="preload" as="style" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}" media="print"
        onload="this.media='all'">

    <link href="{{ asset('frontend/assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/elpath.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/switcher-style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/odometer.css') }}" rel="stylesheet">
    @if (app()->getLocale() == 'en')
        <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    @endif
    @yield('about-links')
    @yield('service')
    @yield('contact')
    <link href="{{ asset('frontend/assets/css/module-css/banner.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/about.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/assets/css/module-css/service.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/working.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/cta.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/testimonial.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/custom.css') }}" rel="stylesheet">
    @if (app()->getLocale() == 'da' || app()->getLocale() == 'pa')
        <link href="{{ asset('frontend/assets/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/assets/css/style_dari.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/assets/css/da_pa.css') }}" rel="stylesheet">
    @endif
    @if (app()->getLocale() == 'pa')
        <link href="{{ asset('frontend/assets/css/pashto.css') }}" rel="stylesheet">
    @endif
    <link href="{{ asset('backend/assets/dist/css/toastr.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/css/common.css') }}" rel="stylesheet">
    {{-- for gallery video --}}
    <style>
        .play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: red;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 15px;
            cursor: pointer;
        }

        .play-btn i {
            pointer-events: none;
            /* فقط کلیک روی لینک اصلی */
        }
    </style>


</head>
<!-- page wrapper -->

<body>
    <div class="boxed_wrapper ltr">
        <!-- preloader -->
        <!-- preloader -->
        @php
            if (app()->getLocale() == 'en') {
                $slagon = ['A', 's', 'i', 'a', 'l', 'a', 'b'];
            } else {
                $slagon = ['آسیا لب'];
            }
        @endphp

        <div class="loader-wrap" aria-hidden="true"
            style="position:fixed;inset:0;display:flex;align-items:center;justify-content:center;background:#fff;z-index:9999;">
            <div class="preloader">
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader position-relative">
                        <div class="spinner"></div>
                        <div class="txt-loading position-absolute loading-logo">
                            @php
                                $generalSetting = App\Models\GeneralSetting::first();
                            @endphp
                            <span class="letters-loading">
                                <img src="{{ asset($generalSetting->logo) }}" alt="asia-lab-logo" width="120"
                                    class="text-center">

                            </span>
                            {{-- @foreach ($slagon as $sla)
                                <span data-text-preloader="{{ $sla }}" class="letters-loading">
                                    {{ $sla }}
                                </span>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Remove preloader as soon as DOM is ready (not waiting for all assets)
            document.addEventListener("DOMContentLoaded", () => {
                const loader = document.querySelector(".loader-wrap");
                if (loader) {
                    loader.style.opacity = "0";
                    loader.style.transition = "opacity 0.5s ease";
                    setTimeout(() => loader.style.display = "none", 1000);
                }
            });
        </script>
        <!-- preloader end -->

        <!-- preloader end -->


        <!--Search Popup-->
        @include('frontend.section.search')


        <!-- main header -->
        <header class="main-header">
            <!-- header-top -->
            @include('frontend.layouts.header')
            <!-- header-lower -->
            @include('frontend.layouts.lower_navbar')
            <!--sticky Header-->
            @include('frontend.layouts.sticky_navbar')
        </header>
        <!-- main-header end -->


        <!-- Mobile Menu  -->
        @include('frontend.layouts.mobile_navbar')

        <!-- End Mobile Menu -->


        <!-- main-content -->
        <main class="main-content alternat-2">
            <!-- banner-section -->
            @if (request()->routeIs(['home']))
                @include('frontend.section.slider')
            @endif
            @yield('homePage')
            <!-- banner-section end -->
            <!-- about-section -->
            @if (request()->routeIs(['home', 'home.about']))
                @include('frontend.section.about')
            @endif
            @if (request()->routeIs(['home.about']))
                @include('frontend.section.vision')
                @include('frontend.section.mission')
                @include('frontend.section.key_value')
            @endif
            <!-- about-section end -->
            @if (request()->routeIs(['home']))
                @include('frontend.section.faq')
                @include('frontend.section.testimonail')
            @endif



            <!-- service-section -->
            @if (request()->routeIs(['home.service']))
                @include('frontend.section.service')
            @endif
            <!-- service-section end -->


            <!-- clients-section -->
            {{-- @if (request()->routeIs(['home', 'home.service', 'home.service.details']))
                @include('frontend.section.client_section')
                @include('frontend.section.machine_slider')
            @endif --}}

            <!-- clients-section end -->


            <!-- working-section -->
            @if (request()->routeIs(['home']))
                @include('frontend.section.working_section')
            @endif
            <!-- working-section end -->
        </main>
        @foreach ($contacts as $contact)
            @if ($contact->video_links)
                <div class="modal fade" id="videoModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title text-white">
                                    {{ $contact->getTranslation('state', app()->getLocale()) }} - Video
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="ratio ratio-16x9">
                                    <iframe id="videoIframe{{ $contact->id }}"
                                        src="{{ str_replace('watch?v=', 'embed/', $contact->video_links) }}"
                                        title="YouTube video" allow="autoplay; encrypted-media" allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach


        <!-- main-content end -->


        <!-- main-footer -->
        @include('frontend.layouts.footer')

        <!-- main-footer end -->



        <!--Scroll to top-->
        <div class="scroll-to-top">
            <svg class="scroll-top-inner" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

    </div>


    <!-- jequery plugins -->
    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.lang-select').niceSelect();

            function decorateNiceSelect($sel) {
                var $nice = $sel.next('.nice-select');
                var $selected = $sel.find('option:selected');
                var img = $selected.data('img');
                var text = $selected.text();
                if (img) $nice.find('.current').html('<img src="' + img + '" alt=""> <span>' + text + '</span>');
                else $nice.find('.current').text(text);

                $nice.find('.list .option').each(function(index) {
                    var $opt = $sel.find('option').eq(index);
                    var optImg = $opt.data('img');
                    var optText = $opt.text();
                    if (optImg) $(this).html('<img src="' + optImg + '" alt=""> <span>' + optText +
                        '</span>');
                    else $(this).text(optText);
                });
            }
            $('.lang-select').each(function() {
                var $sel = $(this);
                decorateNiceSelect($sel);

                $sel.on('change', function() {
                    decorateNiceSelect($sel);
                    let url = $(this).val();
                    if (url) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>

    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jQuery.style.switcher.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/scrolltop.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ScrollTrigger.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/SplitText.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/odometer.js') }}"></script>
    @yield('about-js-links')
    @yield('contact-js')

    <!-- main-js -->
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>

    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
    <script>
        $(window).on('load', function() {
            var $grid = $('.items-container').isotope({
                itemSelector: '.masonry-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.masonry-item'
                }
            });
            $grid.imagesLoaded().progress(function() {
                $grid.isotope('layout');
            });
        });
    </script>

    <script src="{{ asset('backend/assets/dist/js/toastr.js') }}"></script>
    <script>
        @if (Session::has('message'))
            let type = "{{ Session::get('alert-type', 'info') }}";
            let message = "{{ Session::get('message') }}";
            switch (type) {
                case 'info':
                    toastr.info(message);
                    break;
                case 'success':
                    toastr.success(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'error':
                    toastr.error(message);
                    break;
            }
        @endif
    </script>

    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>

{{-- for gallery video --}}
    <script>
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('show.bs.modal', function() {
                let iframe = modal.querySelector('iframe');
                if (iframe) {
                    let src = iframe.getAttribute('src');
                    if (!src.includes('autoplay=1')) {
                        iframe.setAttribute('src', src + '?autoplay=1');
                    }
                }
            });

            modal.addEventListener('hidden.bs.modal', function() {
                let iframe = modal.querySelector('iframe');
                if (iframe) {
                    iframe.setAttribute('src', iframe.getAttribute('src').replace('?autoplay=1', ''));
                }
            });
        });
    </script>








</body><!-- End of .page_wrapper -->



</html>
