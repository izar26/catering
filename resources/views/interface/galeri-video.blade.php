@extends('layouts.app')

@section('title', 'Video Galeri')

@section('interface')
<section id="gallery" class="gallery section mt-custom">
  <div class="container section-title" data-aos="fade-up">
    <h2>Galeri Video</h2>
    <p>Kumpulan video dari kegiatan kami</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">
      @foreach ($galeris as $galeri)
        @php
            $embedLink = $galeri->file;

            if (str_contains($galeri->file, 'youtu.be')) {
                $videoId = preg_replace('/https:\/\/youtu\.be\/([^\?]+)/', '$1', $galeri->file);
                $embedLink = "https://www.youtube.com/embed/$videoId";
            } elseif (str_contains($galeri->file, 'watch?v=')) {
                $videoId = explode('watch?v=', $galeri->file)[1];
                $videoId = explode('&', $videoId)[0];
                $embedLink = "https://www.youtube.com/embed/$videoId";
            }
        @endphp

        <div class="col-md-6 col-lg-4 mb-4">
          <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
            <iframe 
              src="{{ $embedLink }}" 
              title="{{ $galeri->judul }}" 
              allowfullscreen 
              class="w-100 h-100">
            </iframe>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
