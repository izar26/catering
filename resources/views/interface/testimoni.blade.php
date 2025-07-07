@extends('layouts.app')

@section('title', 'Testimoni')

@section('interface')

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section mt-custom">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni</h2>
        <p>Kesan dari mereka yang telah merasakan layanan kami</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            @foreach ( $testimonis as $testimoni )
              <div class="swiper-slide">
                <div class="testimonial-item" ="">
              <p>
                <i class=" bi bi-quote quote-icon-left"></i>
                  <span>{{ $testimoni->isi }}</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                  <img src="{{ asset('storage/' . $testimoni->foto) }}" class="testimonial-img" alt="">
                  <h3>{{ $testimoni->nama }}</h3>
                  <h4>{{ $testimoni->aktor }}</h4>
                  {{-- nih yang atas itu aktor sama saya ga di hidupin yang bawah karna belum ada colum nya --}}
                  {{-- <h4>{{ $testimoni->aktor }}</h4> --}}
                </div>
              </div><!-- End testimonial item -->
            @endforeach

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->
@endsection