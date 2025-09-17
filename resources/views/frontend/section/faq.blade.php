       @php
           $faqs = App\Models\Faq::where('status', 1)->get();
       @endphp
       <section class="faq-section pt_120 pb_120">
           <div class="pattern-layer">
               <div class="pattern-1" style="background-image: url(assets/images/shape/shape-17.png);"></div>
           </div>
           <div class="auto-container">
               <div class="sec-title mb_70 centred sec-title-animation animation-style2">
                   <span class="sub-title mb_20 title-animation">{{ __('message.faq_top_title') }}</span>
                   <h2 class="title-animation">{{ __('message.faq_title') }}</h2>
               </div>
               <div class="inner-container">
                   <ul class="accordion-box">
                       @foreach ($faqs as $index => $faq)
                           <li class="accordion block">
                               <div class="acc-btn {{ $index == 0 ? 'active' : '' }}">
                                   <h4><span>{{ $index+1 }} .</span>{{ $faq->getTranslation('question',app()->getLocale()) }}</h4>
                               </div>
                               <div class="acc-content {{ $index == 0 ? 'current' : '' }}">
                                   <div class="content">
                                       <p>{{ $faq->getTranslation('answear',app()->getLocale()) }}</p>
                                   </div>
                               </div>
                           </li>
                       @endforeach


                   </ul>
               </div>
           </div>
       </section>
