      @php
          $pohtos = App\Models\Photo::where('type', 'company')->get();
      @endphp
      <section class="clients-section">
          <div class="outer-container">
              <div class="clients-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                  @foreach ($pohtos as $photo)
                      <figure class="clients-logo d-flex justify-content-center align-items-center"><img
                                  src="{{ asset($photo->image) }}" alt="company-logo-{{ $photo->id }}" loading="lazy">
                      </figure>
                  @endforeach
              </div>
          </div>
      </section>
