@extends('layouts.app')

@section('title', 'Form-Testimoni')

@section('interface')

    <!-- Book A Table Section -->
    <section id="book-a-table" class="book-a-table section mt-custom">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>TESTIMONI</h2>
        <p>Form Testimoni</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        
        <form action="{{ route('testimoni.store')}}" method="post" role="form" class="testimoni-form" enctype="multipart/form-data">
          @csrf
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Kamu" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="text" class="form-control" name="aktor" id="aktor" placeholder="Profesi Kamu" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="file" class="form-control" name="foto" id="phone" placeholder="Your Phone" accept="image/*" >
            </div>
            <div class="col-lg-4 col-md-6">
              <select name="rating" id="rating" class="form-select" required>
                  <option value="" >-- Beri Rating --</option>
                  @for ($i = 5; $i >= 1; $i--)
                      <option value="{{ $i }}">
                          {{ $i }} Bintang
                      </option>
                  @endfor
              </select>
            </div>
          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="isi" id="isi" rows="5" placeholder="Message"></textarea>
          </div>

          <div class="text-center mt-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            @if(session('sent'))
              <div class="sent-message">{{ session('sent') }}</div>
            @endif
            <button type="submit">Submit</button>
          </div>
        </form><!-- End Reservation Form -->

      </div>

    </section>
    <!-- /Book A Table Section -->

    <script>
      // Saat DOM selesai dimuat
      document.addEventListener('DOMContentLoaded', function () {
        const sentMessage = document.querySelector('.sent-message');
        if (sentMessage) {
          setTimeout(() => {
            sentMessage.style.opacity = '0';
            setTimeout(() => {
              sentMessage.style.display = 'none';
            }, 500); // tunggu animasi fade out selesai
          }, 3000); // tunggu 3 detik sebelum mulai fade out
        }
      });
    </script>


@endsection