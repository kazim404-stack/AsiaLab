<!DOCTYPE html>
<html
    @if (app()->getLocale() == 'en') lang="en" dir="ltr" @elseif (app()->getLocale() == 'pa') lang="fa" dir="rtl" @else lang="ps" dir="rtl" @endif>

<!-- Mirrored from azim.hostlin.com/Labout/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Aug 2025 08:59:05 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Asia Lab offers trusted laboratory testing in Histology, Hematology, Pathology, Biochemistry, PCR, Microbiology, Virology, Immunology, and more.">
    <meta name="keywords"
        content="Asia Lab, Laboratory, Histology, Hematology, Pathology, Biochemistry, PCR, Microbiology, Virology, Immunology, Cytology, Parasitology, Serology, Screening, Mycology, Vaccination, Endocrinology">



    <title>Asia Lab</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('backend/assets/images/favoicon.webp') }}" type="image/webp" />


    <!-- Google Fonts -->
    @if (app()->getLocale() == 'en')
        <link
            href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
            rel="stylesheet">
    @endif


    @if (app()->getLocale() == 'da')
        <link
            href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
    @endif
    @if (app()->getLocale() == 'pa')
        <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap"
            rel="stylesheet">
    @endif



    <!-- Stylesheets -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('frontend/assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/flaticon.css') }}" rel="stylesheet">
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
    <link href="{{ asset('frontend/assets/css/module-css/feature.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/funfact.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/service.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/clients.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/working.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/events.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/cta.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/module-css/team.css') }}" rel="stylesheet">
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
    <link href="{{ asset('frontend/assets/css/common.css') }}" rel="stylesheet">

</head>
<!-- page wrapper -->

<body>
    <div class="boxed_wrapper ltr">
        <!-- preloader -->
        @php
            if (app()->getLocale() == 'en') {
                $slagon = ['A', 's', 'i', 'a', 'l', 'a', 'b'];
            } else {
                $slagon = ['آسیا لب'];
            }
        @endphp
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">close</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            @foreach ($slagon as $sla)
                                <span data-text-preloader="{{ $sla }}" class="letters-loading">
                                    {{ $sla }}
                                </span>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                @include('frontend.section.faq')
                @include('frontend.section.testimonail')
            @endif
            <!-- about-section end -->



            <!-- service-section -->
            @if (request()->routeIs(['home', 'home.service']))
                @include('frontend.section.service')
            @endif
            <!-- service-section end -->


            <!-- clients-section -->
            @if (request()->routeIs(['home', 'home.service','home.service.details']))
                @include('frontend.section.client_section')
                @include('frontend.section.machine_slider')
            @endif

            <!-- clients-section end -->


            <!-- working-section -->
            @if (request()->routeIs(['home']))
                @include('frontend.section.working_section')
            @endif
            <!-- working-section end -->
        </main>
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
    <script src="{{ asset('frontend/assets/js/validation.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/language.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scrolltop.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ScrollTrigger.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/SplitText.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/odometer.js') }}"></script>
    @yield('about-js-links')
    @yield('contact-js')

    <!-- main-js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>




</body><!-- End of .page_wrapper -->

<!-- Mirrored from azim.hostlin.com/Labout/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Aug 2025 08:59:05 GMT -->

</html>
