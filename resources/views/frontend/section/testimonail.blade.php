   @php
       $testimonails = App\Models\Testimonail::where('status', 1)->get();
   @endphp
   <section class="testimonial-section pt_120 pb_120">
       <div class="auto-container">
           <div class="sec-title centred mb_70 sec-title-animation animation-style2">
               <span class="sub-title mb_20 title-animation">{{ __('message.testimonails') }}</span>
               <h2 class="title-animation">{{ __('message.love from clients') }}</h2>
           </div>
           <div class="two-item-carousel owl-carousel owl-theme dots-style-one owl-nav-none testimonail-carousel">
               @foreach ($testimonails as $testimonail)
                   <div class="testimonial-block-one">
                       <div class="inner-box">
                           <div class="icon-box">
                               <div class="r-hex">
                                   <div class="r-hex-inner"></div>
                               </div>
                               <div class="icon"><i class="icon-35"></i></div>
                           </div>
                           <p>"{{ $testimonail->getTranslation('description',app()->getLocale()) }}"</p>
                           <div class="lower-box">
                               <div class="author-box">
                                   <figure class="thumb-box"><img src="assets/images/resource/testimonial-1.png"
                                           alt=""></figure>
                                   <h3>{{ $testimonail->getTranslation('name',app()->getLocale()) }}</h3>
                                   <span class="designation">{{ $testimonail->getTranslation('position',app()->getLocale()) }}</span>
                               </div>
                               <ul class="rating">
                                @for ($i = 1; $i<=$testimonail->rate; $i++)
                                <li><i class="fas fa-star"></i></li>
                                @endfor

                               </ul>
                           </div>
                       </div>
                   </div>
               @endforeach

               {{-- <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="r-hex"><div class="r-hex-inner"></div></div>
                                    <div class="icon"><i class="icon-35"></i></div>
                                </div>
                                <p>"The laboratory service exceeded our expectations in terms of these reliability and precision. The team demonstrated a commitment to the excellence, and their attention to detail ensured that our experiments were conducted with the utmost accuracy."</p>
                                <div class="lower-box">
                                    <div class="author-box">
                                        <figure class="thumb-box"><img src="assets/images/resource/testimonial-2.png" alt=""></figure>
                                        <h3>Brooklyn Simmons</h3>
                                        <span class="designation">Designer</span>
                                    </div>
                                    <ul class="rating">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="r-hex"><div class="r-hex-inner"></div></div>
                                    <div class="icon"><i class="icon-35"></i></div>
                                </div>
                                <p>"We have been relying on the laboratory services for years, and the consistently reliable results have played a crucial role in maintaining the high standards of our product quality. The professionalism and expertise of the staff are truly commendable."</p>
                                <div class="lower-box">
                                    <div class="author-box">
                                        <figure class="thumb-box"><img src="assets/images/resource/testimonial-1.png" alt=""></figure>
                                        <h3>Jenifer Laurence</h3>
                                        <span class="designation">Manager</span>
                                    </div>
                                    <ul class="rating">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="r-hex"><div class="r-hex-inner"></div></div>
                                    <div class="icon"><i class="icon-35"></i></div>
                                </div>
                                <p>"The laboratory service exceeded our expectations in terms of these reliability and precision. The team demonstrated a commitment to the excellence, and their attention to detail ensured that our experiments were conducted with the utmost accuracy."</p>
                                <div class="lower-box">
                                    <div class="author-box">
                                        <figure class="thumb-box"><img src="assets/images/resource/testimonial-2.png" alt=""></figure>
                                        <h3>Brooklyn Simmons</h3>
                                        <span class="designation">Designer</span>
                                    </div>
                                    <ul class="rating">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="r-hex"><div class="r-hex-inner"></div></div>
                                    <div class="icon"><i class="icon-35"></i></div>
                                </div>
                                <p>"We have been relying on the laboratory services for years, and the consistently reliable results have played a crucial role in maintaining the high standards of our product quality. The professionalism and expertise of the staff are truly commendable."</p>
                                <div class="lower-box">
                                    <div class="author-box">
                                        <figure class="thumb-box"><img src="assets/images/resource/testimonial-1.png" alt=""></figure>
                                        <h3>Jenifer Laurence</h3>
                                        <span class="designation">Manager</span>
                                    </div>
                                    <ul class="rating">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-block-one">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <div class="r-hex"><div class="r-hex-inner"></div></div>
                                    <div class="icon"><i class="icon-35"></i></div>
                                </div>
                                <p>"The laboratory service exceeded our expectations in terms of these reliability and precision. The team demonstrated a commitment to the excellence, and their attention to detail ensured that our experiments were conducted with the utmost accuracy."</p>
                                <div class="lower-box">
                                    <div class="author-box">
                                        <figure class="thumb-box"><img src="assets/images/resource/testimonial-2.png" alt=""></figure>
                                        <h3>Brooklyn Simmons</h3>
                                        <span class="designation">Designer</span>
                                    </div>
                                    <ul class="rating">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
           </div>
       </div>
   </section>
