@extends('layouts.app')

@section('title', 'Beranda')

@section('interface')
    @php
      // Pecah berdasarkan paragraf (misalnya pakai newline ganda)
      $paragraf = preg_split('/\r\n|\r|\n/', $profil->tentang_kami);
      $paragraf = array_filter($paragraf); // Buang yang kosong
      $paragraf = array_values($paragraf); // Reset index jadi 0,1,2,...
    @endphp

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="{{ asset('img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-8 d-flex flex-column align-items-center align-items-lg-start">
            <h2 data-aos="fade-up" data-aos-delay="100">Welcome to <span>{{ $profil->nama_perusahaan }}</span></h2>
            <p data-aos="fade-up" data-aos-delay="200">{{ $profil->deskripsi }}</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
              <a href="{{ route('menu')}}" class="{{ request()->is('menu') ? 'active' : '' }} cta-btn">Our Menu</a>
            </div>
          </div>
          <div class="col-lg-4 d-flex align-items-center justify-content-center mt-5 mt-lg-0">
            @if ($video)
              <a href="{{ $video->file }}" class="glightbox-video-beranda pulsating-play-btn"></a>
            @endif
          </div>
        </div>
      </div>

    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="{{ asset('img/about.jpg') }}" class="img-fluid about-img" alt="">
          </div>
          <div class="col-lg-6 order-2 order-lg-1 content">
            <h3>Tentang Kami</h3>

            {{-- Paragraf pertama --}}
            @if(isset($paragraf[0]))
              <p class="fst-italic">
                {{ $paragraf[0] }}
              </p>
            @endif
            
            {{-- Paragraf tengah (jika lebih dari 2 paragraf) --}}
            @if(count($paragraf) > 2)
              <ul>
                @foreach(array_slice($paragraf, 1, -1) as $isi)
                  <li><i class="bi bi-check2-all"></i> <span>{{ $isi }}</span></li>
                @endforeach
              </ul>
            @endif
            
            {{-- Paragraf terakhir --}}
            @if(count($paragraf) > 1)
              <p>{{ $paragraf[count($paragraf) - 1] }}</p>
            @endif
          </div>
        </div>

      </div>

    </section>
    <!-- /About Section -->
    
    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>MENGAPA MEMILIH KAMI</h2>
        <p>Kami berkomitmen memberikan pengalaman catering terbaik, mulai dari rasa hingga pelayanan.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card-item">
              <span>01</span>
              <h4><a href="" class="stretched-link">Rasa yang Tak Pernah Mengecewakan</a></h4>
              <p>Setiap hidangan diracik dengan bahan pilihan dan cita rasa yang konsisten, cocok untuk semua jenis acara.</p>
            </div>
          </div><!-- Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card-item">
              <span>02</span>
              <h4><a href="" class="stretched-link">Pelayanan Profesional</a></h4>
              <p>Tim kami siap membantu dengan pelayanan ramah, cepat tanggap, dan penuh tanggung jawab dari awal hingga akhir acara.</p>
            </div>
          </div><!-- Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card-item">
              <span>03</span>
              <h4><a href="" class="stretched-link">Tampilan Sajian yang Elegan</a></h4>
              <p>Penyajian yang rapi dan estetik menjadikan setiap meja terlihat menarik dan meningkatkan kesan pada tamu Anda.</p>
            </div>
          </div><!-- Card Item -->

        </div>

      </div>

    </section><!-- /Why Us Section -->

    
    {{-- <!-- Specials Section --> --}}
    <section id="specials" class="specials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Specials</h2>
        <p>Check Our Specials</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              @foreach($produkUnggulan as $produk)
                <li class="nav-item">
                  <a class="nav-link @if($loop->first) active show @endif" data-bs-toggle="tab" href="#produk-{{ $produk->id }}">{{ $produk->nama }}</a>
                </li>
              @endforeach
              {{-- <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#specials-tab-1">Modi sit est</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-2">Unde praesentium sed</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-3">Pariatur explicabo vel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-4">Nostrum qui quasi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-5">Iusto ut expedita aut</a>
              </li> --}}
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              @foreach($produkUnggulan as $key => $produk)
                <div class="tab-pane @if($key == 0) active show @endif" id="produk-{{ $produk->id }}">
                  <div class="row">
                    <div class="col-lg-8 details order-2 order-lg-1">
                      <h3>{{ $produk->nama }}</h3>
                      <p>{{ $produk->deskripsi }}</p>
                    </div>
                    <div class="col-lg-4 text-center order-1 order-lg-2">
                      <img src="{{ asset('storage/' . $produk->gambar) }}" alt="" class="img-fluid">
                    </div>
                  </div>
                </div>
              @endforeach

              {{-- <div class="tab-pane active show" id="specials-tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Architecto ut aperiam autem id</h3>
                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                    <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('img/specials-1.png') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="specials-tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Et blanditiis nemo veritatis excepturi</h3>
                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                    <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('img/specials-2.png') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="specials-tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Impedit facilis occaecati odio neque aperiam sit</h3>
                    <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                    <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum voluptatem optio quae</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('img/specials-3.png') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="specials-tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Fuga dolores inventore laboriosam ut est accusamus laboriosam dolore</h3>
                    <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis delectus</p>
                    <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum inventore</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('img/specials-4.png') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="specials-tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Est eveniet ipsam sindera pad rone matrelat sando reda</h3>
                    <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                    <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae molestiae voluptate vel</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('img/specials-5.png') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div> --}}
            </div>
          </div>
        </div>

      </div>

    </section>
    <!-- /Specials Section -->

    
    <!-- Events Section -->
    <section id="events" class="events section">

      <img class="slider-bg" src="{{ asset('img/events-bg.jpg') }}" alt="" data-aos="fade-in">

      <div class="container">

        <div class="swiper init-swiper" data-aos="fade-up" data-aos-delay="100">
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
              }
            }
          </script>
          <div class="swiper-wrapper">

            @foreach($produkPrevent as $produk)
              @php
                // Pisahkan deskripsi jadi array per paragraf (pakai Enter)
                $paragraf = preg_split('/\r\n|\r|\n/', $produk->deskripsi);
                $paragraf = array_filter($paragraf); // Buang baris kosong
                $paragraf = array_values($paragraf); // Reset index
              @endphp
            
              <div class="swiper-slide">
                <div class="row gy-4 event-item">
                  <div class="col-lg-6">
                    <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-6 pt-4 pt-lg-0 content">
                    <h3>{{ $produk->nama }}</h3>
                    <div class="price">
                      <p><span>Rp {{ number_format($produk->harga, 0, ',', '.') }}</span></p>
                    </div>
                  
                    {{-- Paragraf pertama --}}
                    @if(isset($paragraf[0]))
                      <p class="fst-italic">{{ $paragraf[0] }}</p>
                    @endif
                  
                    {{-- List isi tengah --}}
                    @if(count($paragraf) > 2)
                      <ul>
                        @foreach(array_slice($paragraf, 1, -1) as $isi)
                          <li><i class="bi bi-check2-circle"></i> <span>{{ $isi }}</span></li>
                        @endforeach
                      </ul>
                    @endif
                    
                    {{-- Paragraf terakhir --}}
                    @if(count($paragraf) > 1)
                      <p>{{ $paragraf[count($paragraf) - 1] }}</p>
                    @endif
                  </div>
                </div>
              </div><!-- End Slider item -->
            @endforeach

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Events Section -->

    <!-- Paket Buffet Section -->
    <section id="paket" class="why-us section mt-custom">
      <div class="container section-title" data-aos="fade-up">
        <h2>PAKET BUFFET</h2>
        <p>Pilihan paket buffet terbaik untuk berbagai jenis acara Anda.</p>
      </div>
    
      <div class="container">
        <div class="row gy-4">
          @foreach($paketans as $index => $paket)
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
            <div class="card-item d-flex flex-column align-items-center text-center">
              <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
              <!-- Tambahkan gambar di sini -->
              <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama }}" class="img-fluid mb-3" style="width:50%; height:50%; object-fit:cover;">
              <h4>
                <a href="#modal-paket-{{ $paket->id }}" class="glightbox" data-gallery="paket-gallery" data-type="inline">
                  {{ $paket->nama }}
                </a>
              </h4>
              <p>Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
            </div>
            
            {{-- Modal Partial --}}
            @include('components.paketan-modal', ['paket' => $paket, 'profil' => $profil])
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- /Paket Buffet Section -->
    <section id="info-pemesanan" class="info-pemesanan section">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Info Pemesanan</h2>
      <p>Informasi pemesanan paket di {{ $profil->nama_perusahaan }}</p>
    </div>

    <div class="row gy-4 text-center">

      <!-- Pemesanan -->
      <div class="col-lg-4 col-md-6">
        <div class="icon"><i class="bi bi-telephone" style="color: #f89d13; font-size: 40px;"></i></div>
        <h5 class="mt-3">Pemesanan</h5>
        <p>
          Alamat: {{ $profil->alamat }}<br>
          WhatsApp: <a href="https://wa.me/{{ $profil->no_wa }}">+{{ $profil->no_wa }}</a><br><br>
          <strong>Service Hours:</strong><br>
          {{ $profil->service_hours }}<br>
          Fast Response Chat {{ $profil->fast_response}}
        </p>
      </div>

      <!-- Pengiriman -->
      <div class="col-lg-4 col-md-6">
        @php
          $parts = preg_split("/\r\n|\r|\n/", trim($info->info_pengiriman));
        @endphp
        <div class="icon"><i class="bi bi-truck" style="color: #f89d13; font-size: 40px;"></i></div>
        <h5 class="mt-3">Pengiriman</h5>
        @foreach ($parts as $paragraph)
          @if (trim($paragraph) !== '')
            <p>{{ $paragraph }}</p>
          @endif
        @endforeach
      </div>

      <!-- Pembayaran -->
      <div class="col-lg-4 col-md-6">
        @php
          $parts = preg_split("/\r\n|\r|\n/", trim($info->info_pembayaran));
        @endphp
        <div class="icon"><i class="bi bi-cash-coin" style="color: #f89d13; font-size: 40px;"></i></div>
        <h5 class="mt-3">Pembayaran</h5>
        @foreach ($parts as $paragraph)
          @if (trim($paragraph) !== '')
            <p>{{ $paragraph }}</p>
          @endif
        @endforeach
      </div>

      <div class="col-lg-2 col-md-6">
      </div>
      <!-- Pembatalan -->
      <div class="col-lg-4 col-md-6">
        @php
          $parts = preg_split("/\r\n|\r|\n/", trim($info->info_pembatalan));
        @endphp
        <div class="icon"><i class="bi bi-x-circle" style="color: #f89d13; font-size: 40px;"></i></div>
        <h5 class="mt-3">Pembatalan</h5>
        @foreach ($parts as $paragraph)
          @if (trim($paragraph) !== '')
            <p>{{ $paragraph }}</p>
          @endif
        @endforeach
      </div>

      <!-- Harga & Biaya -->
      <div class="col-lg-4 col-md-6">
        @php
          $parts = preg_split("/\r\n|\r|\n/", trim($info->info_harga));
        @endphp
        <div class="icon"><i class="bi bi-tag" style="color: #f89d13; font-size: 40px;"></i></div>
        <h5 class="mt-3">Harga & Biaya</h5>
        @foreach ($parts as $paragraph)
          @if (trim($paragraph) !== '')
            <p>{{ $paragraph }}</p>
          @endif
        @endforeach
      </div>
      <div class="col-lg-2 col-md-6">
      </div>

    </div>
  </div>
</section>

@endsection