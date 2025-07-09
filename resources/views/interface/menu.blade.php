@extends('layouts.app')

@section('title', 'Menu')

@section('interface')
@php
    use Illuminate\Support\Str;
@endphp

    <!-- Menu Section -->
    <section id="menu" class="menu section mt-custom">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Menu</h2>
        <p>Lihat Menu Lezat Kami</p>
      </div><!-- End Section Title -->

      <div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul class="menu-filters isotope-filters">
              <li data-filter="*" class="filter-active">All</li>
              @foreach ($kategoris as $kategori)
                <li data-filter=".filter-{{ Str::slug($kategori->nama) }}">{{ $kategori->nama }}</li>
              @endforeach
            </ul>
          </div>
        </div><!-- Menu Filters -->

        <div class="row isotope-container" data-aos="fade-up" data-aos-delay="200">

          @foreach ($menus as $menu)
            <div class="col-lg-6 menu-item isotope-item filter-{{ Str::slug($menu->kategori->nama) }}">
              <img src="{{ asset('storage/' . $menu->gambar) }}" class="menu-img" alt="">
              <div class="menu-content">
                <a href="#">{{ $menu->nama }}</a><span>Rp {{ number_format($menu->harga) }}</span>
              </div>
              <div class="menu-ingredients">
                {{ $menu->deskripsi }}
              </div>
            </div>
          @endforeach<!-- Menu Item -->

        </div><!-- Menu Container -->

      </div>

    </section><!-- /Menu Section -->
@endsection