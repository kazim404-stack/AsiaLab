             @php
                 $generalSetting = App\Models\GeneralSetting::first();
                 $contact = App\Models\Contact::where('email', 'inf@asialab.af')
                     ->with([
                         'phones',
                         'province' => function ($query) {
                             $query->where('province', 'Herat master branch');
                         },
                     ])
                     ->first();
             @endphp
             <div class="mobile-menu">
                 <div class="menu-backdrop"></div>
                 <div class="close-btn"><i class="fas fa-times"></i></div>

                 <nav class="menu-box">
                     <div class="nav-logo"><a href="{{ route('home') }}"><img src="{{ asset($generalSetting->logo) }}"
                                 alt="asia-lab-logo" width="80"></a>
                     </div>
                     <div class="menu-outer">
                         <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                     </div>
                     <div class="contact-info">
                         <h4>{{ __('message.contact_info') }}</h4>
                         <ul>
                             <li>{{ $contact->getTranslation('address',app()->getLocale()) }}</li>
                             @foreach ($contact->phones as $phone)
                                 <li class="footer-phone"><a href="tel:{{ $phone->phone_number }}" >{{ $phone->phone_number }}</a></li>
                             @endforeach
                             <li><a href="mailto:info@example.com">{{ $contact->email }}</a></li>
                         </ul>
                     </div>
                     <div class="social-links">
                         <ul class="clearfix">
                             @if ($generalSetting->facebook)
                                 <li><a href="{{ $generalSetting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                 </li>
                             @endif
                             @if ($generalSetting->x)
                                 <li><a href="{{ $generalSetting->x }}"><i class="fab fa-twitter"></i></a></li>
                             @endif
                             @if ($generalSetting->linkedin)
                                 <li><a href="{{ $generalSetting->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                 </li>
                             @endif
                             @if ($generalSetting->instagram)
                                 <li><a href="{{ $generalSetting->instagram }}"><i class="fab fa-instagram"></i></a>
                                 </li>
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
                 </nav>
             </div>
