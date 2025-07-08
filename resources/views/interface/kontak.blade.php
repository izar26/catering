@extends('layouts.app')

@section('title', 'kontak')

@section('interface')

    <style>
.info-item a {
  color: inherit;
  text-decoration: none;
  transition: color 0.3s ease;
}

.info-item a:hover {
  color:#cda45e;
}
</style>

    <!-- Contact Section -->
    <section id="kontak" class="contact section mt-custom">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Hubungi Kami</p>
      </div><!-- End Section Title -->

      <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 400px;" src="https://maps.google.com/maps?q={{ urlencode($profil->alamat) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4" data-aos="fade-up">

          <div class="col-md-3">
            <div class="info-item d-flex">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Lokasi</h3>
                <p>{{ $profil->alamat }}</p>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="info-item d-flex">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Jam Buka</h3>
                <p>{{ $profil->service_hours}}:<br>{{ $profil->fast_response }}</p>
              </div>
            </div>
          </div>

          @php
            $nomors = explode(',', $profil->no_wa);
          @endphp
          <div class="col-md-3">
            <div class="info-item d-flex">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Hubungi Kami</h3>
                @foreach($nomors as $no)
                  <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $no) }}" target="_blank">
                    {{ $no }}
                  </a><br>
                @endforeach
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="info-item d-flex">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Kami</h3>
                <a href="mailto:{{ $profil->email }}">{{ $profil->email }}</a>
              </div>
            </div>
          </div>

        </div>


      </div>

    </section><!-- /Contact Section -->
@endsection