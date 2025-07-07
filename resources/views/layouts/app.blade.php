<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>catering - @yield('title')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('storage/' . $profil->logo) }}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>

<style>
    .mt-custom {
  margin-top: 8rem;
}
</style>


<body class="index-page">

  <header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:{{ $profil->email }}">{{ $profil->email }}</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span><a href="https://wa.me/{{ $profil->no_wa}}">{{ $profil->no_wa }}</a></span></i>
        </div>
        <div class="languages d-none d-md-flex align-items-center">
          <ul>
            <li>In</li>
          </ul>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
          <!-- images logo-->
           <img src="{{ asset('storage/' . $profil->logo) }}" alt="">
          <h1 class="sitename">Catering</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="/#hero" class="{{ request()->is('/') ? 'active' : '' }}">Home<br></a></li>
            <li><a href="/#about">About</a></li>
            <li><a href="/#specials">Spesial</a></li>
            <li><a href="/#paket">Paket</a></li>
            <li><a href="/#events">Events</a></li>
            <li><a href="{{ route('menu')}}" class="{{ request()->is('menu') ? 'active' : '' }}"><span>Menu</span></a></li>
            <li><a href="{{ route('testimoni')}}" class="{{ request()->is('testimoni') ? 'active' : '' }}"><span>Testimoni</span></a></li>
            <li class="dropdown">
              <a href="#"><span>Galeri</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="{{ route('galeri.foto') }}" class="{{ request()->is('galeri/foto') ? 'active' : '' }}">Foto</a></li>
                <li><a href="{{ route('galeri.video') }}" class="{{ request()->is('galeri/video') ? 'active' : '' }}">Video</a></li>
              </ul>
            </li>
            <li><a href="{{ route('kontak')}}" class="{{ request()->is('kontak') ? 'active' : '' }}">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-book-a-table d-none d-xl-block" href="{{ route('testimoni-form')}}">Tulis Testimoni</a>

      </div>

    </div>

  </header>

  <main class="main">

    @yield('interface')

  </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">{{ $profil->nama_perusahaan }}</span>
          </a>
          <div class="footer-contact pt-3">
            <p><strong>Lokasi:</strong></p>
            <p>{{ $profil->alamat }}</p>
            <p class="mt-3"><strong>Phone:</strong> <span>{{ $profil->no_wa }}</span></p>
            <p><strong>Email:</strong> <span>{{ $profil->email }}</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="{{ $profil->instagram }}"><i class="bi bi-instagram"></i></a>
            <a href="{{ $profil->facebook }}"><i class="bi bi-facebook"></i></a>
            <a href="{{ $profil->tiktok }}"><i class="bi bi-tiktok"></i></a>
            <a href="{{ $profil->youtube }}"><i class="bi bi-youtube"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Tautan Penting</h4>
          <ul>
            <li><a href="/#hero">Beranda</a></li>
            <li><a href="/#about">Tentang Kami</a></li>
            <li><a href="/#paket">Paket Buffet</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/kontak">Kontak</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Layanan Kami</h4>
          <ul>
            <li><a href="/#paket">Paket Prasmanan</a></li>
            <li><a href="/#specials">Menu Unggulan</a></li>
            <li><a href="/galeri/foto">Galeri Foto</a></li>
            <li><a href="/reservasi">Reservasi Acara</a></li>
            <li><a href="/testimoni">Testimoni Pelanggan</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Pencarian</h4>
          <p>Ketik kata kunci lalu tekan Enter untuk menuju halaman terkait.</p>
          <form action="{{ route('footer.search') }}" method="GET" class="">
            <div class="newsletter-form">
              <input type="text" name="q"  placeholder="Contoh: menu">
              <input type="submit" value="Cari">

            </div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>2025</span> <strong class="px-1 sitename">Catering</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://www.instagram.com/markmhbr" target="_blank">Markmhbr</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>