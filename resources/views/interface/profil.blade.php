@extends('layouts.app')

@section('title', 'Profil')

@section('interface')

    <!-- Contact Section -->
    <section id="profil" class="contact section mt-custom">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Profil</h2>
        <p>Profil Perusahaan</p>
      </div><!-- End Section Title -->
    
      <div class="container">
        @php
          $parts = preg_split("/\r\n|\r|\n/", trim($profil->deskripsi));
        @endphp
        @foreach ($parts as $paragraph)
          @if (trim($paragraph) !== '')
            <p>{{ $paragraph }}</p>
          @endif
        @endforeach
      </div>
    </section>

@endsection