         @php
             $machines = App\Models\Photo::where('type', 'machine')->get();
         @endphp
         <section class="service-section pt_120 pb_90">
             <div class="bg-layer parallax-bg" data-parallax='{"y": 100}'
                 style="background-image: url({{ asset('frontend/assets/images/background/service-bg.jpg') }});"></div>
             <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-8.png') }});">
             </div>
             <div>
                 <div class="sec-title centred mb_70 sec-title-animation animation-style2">
                     <span class="sub-title mb_20 title-animation">{{ __('message.equipment') }}</span>
                     <h2 class="title-animation">{{ __('message.advanced laboratory equipment') }}</h2>
                 </div>
                 <div class="row">
                     <section class="clients-section">
                         <div class="outer-container">
                             <div class="clients-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                                 @foreach ($machines as $machine)
                                     <figure class="clients-logo d-flex justify-content-center align-items-center"><img loading="lazy" style="width: 200px !important;"
                                                 src="{{ asset($machine->image) }}"
                                                 alt="company-logo-{{ $machine->id }}">
                                     </figure>
                                 @endforeach
                             </div>
                         </div>
                     </section>


                 </div>

             </div>
         </section>
