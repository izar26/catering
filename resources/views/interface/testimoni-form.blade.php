@extends('layouts.app')

@section('title', 'Form-Testimoni')

@section('interface')

  <style>
  .div-star {
    display: flex;
    /* justify-content: center;
    align-items: center; */
    margin-top: 20px;
  }
  .star-rating {
    direction: ltr;
    display: flex;
    gap: 5px;
  }

  .star {
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
  }

  .star.selected,
  .star:hover,
  .star:hover ~ .star {
    color: gold;
  }

  /* hover effect untuk bintang sebelumnya */
  .star:hover ~ .star {
    color: #ccc;
  }
</style>

    <!-- Book A Table Section -->
    <section id="book-a-table" class="book-a-table section mt-custom">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>TESTIMONI</h2>
        <p>Form Testimoni</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        
        <form id="testimoniForm" action="{{ route('testimoni.store')}}" method="post" role="form" class="testimoni-form" enctype="multipart/form-data">
          @csrf
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Kamu" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="text" class="form-control" name="aktor" id="aktor" placeholder="Profesi Kamu" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="file" class="form-control" name="foto" id="phone" placeholder="Your Phone" accept="image/*" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="text" class="form-control" name="nomor_hp" id="phone" placeholder="Your Phone" required="">
            </div>
            <div class="col-lg-4 col-md-6 div-star">
              <div class="star-rating">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
              </div>
              <input type="hidden" name="rating" id="rating" required="">
            </div>
          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="isi" id="isi" rows="5" maxlength="100" placeholder="Message"></textarea>
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

      const stars = document.querySelectorAll('.star-rating .star');
      const ratingInput = document.getElementById('rating');

      stars.forEach((star, index) => {
        star.addEventListener('click', () => {
          const rating = star.getAttribute('data-value');
          ratingInput.value = rating;
        
          // Reset semua bintang
          stars.forEach(s => s.classList.remove('selected'));
        
          // Tambahkan class selected sesuai nilai
          for (let i = 0; i < rating; i++) {
            stars[i].classList.add('selected');
          }
        });
      });

      // Validasi saat submit form
      const form = document.getElementById('testimoniForm'); // ganti sesuai ID form kamu
      form.addEventListener('submit', function(e) {
        if (!ratingInput.value) {
          e.preventDefault(); // Cegah kirim form
          alert('Silakan pilih rating bintang terlebih dahulu.');
        }
      });
    </script>


@endsection