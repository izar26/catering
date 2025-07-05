@extends('layouts.app')

@section('interface')
<section id="gallery" class="gallery section mt-custom">
  <div class="container section-title" data-aos="fade-up">
    <h2>Galeri Foto</h2>
    <p>Kumpulan foto dari kegiatan kami</p>
  </div>

  <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
    <div class="row g-3">
      @foreach ($galeris as $galeri)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="gallery-item rounded overflow-hidden shadow-sm">
            <a href="{{ asset('storage/' . $galeri->file) }}" 
               class="glightbox" 
               data-gallery="images-gallery" 
               data-title="{{ $galeri->judul }}" 
               data-description="{{ $galeri->deskripsi }}">
              <div class="ratio ratio-1x1">
                <img src="{{ asset('storage/' . $galeri->file) }}" 
                     alt="{{ $galeri->judul }}" 
                     class="w-100 h-100" 
                     style="object-fit: cover;">
              </div>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
