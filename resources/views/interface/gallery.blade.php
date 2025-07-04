@extends('layouts.app')

@section('interface')
    
    <!-- Gallery Section -->
    <section id="gallery" class="gallery section mt-custom">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>Some photos from Our Restaurant</p>
      </div><!-- End Section Title -->

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">
          {{-- @foreach ( $galeris as $galeri )
            <div class="col-lg-3 col-md-4">
              <div class="gallery-item">
                <a href="{{ asset('storage/' . $galeri->file) }}" class="glightbox" data-gallery="images-gallery">
                  <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="img-fluid">
                </a>
              </div>
            </div>
          @endforeach --}}
          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-1.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-1.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-2.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-2.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-3.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-3.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-4.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-4.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-5.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-5.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-6.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-6.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-7.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-7.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('img/gallery/gallery-8.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('img/gallery/gallery-8.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>

    </section><!-- /Gallery Section -->
@endsection