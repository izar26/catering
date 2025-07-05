<div id="modal-paket-{{ $paket->id }}" style="display: none;">
  <div class="glightbox-content d-flex justify-content-center">
    <div class="p-4 rounded shadow text-center" style="max-width: 600px; width: 100%;">
      <h2 class="text-dark mb-3">{{ $paket->nama }}</h2>
      <img src="{{ asset('storage/' . $paket->gambar) }}" alt="{{ $paket->nama }}" class="img-fluid mb-3" style="max-width: 20%; height: 20%; border-radius: 10px;">
      
      <p class="text-dark mb-2"><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
      <p class="text-muted">{!! nl2br(e($paket->deskripsi)) !!}</p>
      
      <a href="https://wa.me/{{ $profil->no_wa }}?text=Halo, saya tertarik dengan paket {{ urlencode($paket->nama) }}" target="_blank" class="btn btn-success mt-3">
        <i class="bi bi-whatsapp me-1"></i> Chat WhatsApp
      </a>
    </div>
  </div>
</div>

