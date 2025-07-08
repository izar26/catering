@extends('layouts.admin')

@section('title', 'Profil Usaha')

@section('content')
<form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pengaturan Profil Usaha</h5>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
            </button>
        </div>
        <div class="card-body p-4">

            <div class="row mb-4">
                <div class="col-md-7">
                    <div class="mb-4">
                        <label for="nama_perusahaan" class="form-label fw-bold">Nama Usaha</label>
                        <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $profil->nama_perusahaan) }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="tentang_kami" class="form-label fw-bold">Tentang Kami</label>
                        <textarea id="tentang_kami" name="tentang_kami" class="form-control" rows="4">{{ old('tentang_kami', $profil->tentang_kami) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="video_profil" class="form-label fw-bold">Video Profil</label>
                        <input id="video_profil" name="video_profil" class="form-control" rows="4" value="{{ old('video_profil', $profil->video_profil) }}">
                    </div>
                    
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold">Logo Usaha</label>
                    <div class="file-upload-wrapper text-center">
                        <img id="logo-preview" 
                             src="{{ $profil->logo ? asset('storage/' . $profil->logo) : 'https://via.placeholder.com/400x400.png?text=Pilih+Logo' }}" 
                             alt="Logo preview" class="img-fluid rounded mb-3" style="max-height: 250px; object-fit: contain;">
                        <input type="file" name="logo" id="logo-input" class="d-none" onchange="previewLogo(event)">
                        <label for="logo-input" class="btn btn-outline-primary w-100">
                            <i class="bi bi-upload me-2"></i>Pilih File Logo
                        </label>
                        <div class="form-text mt-2">Gunakan gambar rasio 1:1 (persegi).</div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat lengkap usaha Anda..." oninput="updateMapPreview()">{{ old('alamat', $profil->alamat) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Preview Peta</label>
                <div class="border rounded" style="height: 400px; background-color: #f8f9fa;">
                    <iframe id="mapPreview" width="100%" height="100%" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?q={{ urlencode($profil->alamat) }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
                    </iframe>
                </div>
            </div>

            <hr class="my-4">
            <div class="row">
                <div class="mb-3">
    <label for="service_hours" class="form-label fw-bold">Jam Layanan (Service Hours)</label>
    <input type="text" name="service_hours" id="service_hours" class="form-control" placeholder="Contoh: Senin - Sabtu" value="{{ old('service_hours', $profil->service_hours) }}">
</div>
<div class="mb-3">
    <label for="fast_response" class="form-label fw-bold">Waktu Fast Response</label>
    <input type="text" name="fast_response" id="fast_response" class="form-control" placeholder="Contoh: 10.00 - 20.00" value="{{ old('fast_response', $profil->fast_response) }}">
</div>
            </div>

            <h6 class="fw-bold">Kontak & Sosial Media</h6>
            <hr class="my-4">
            <div class="row">
                
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="no_wa" class="form-label fw-bold">No. WhatsApp</label>
                    <div class="input-group"><span class="input-group-text"><i class="bi bi-whatsapp"></i></span><input type="text" id="no_wa" name="no_wa" class="form-control" placeholder="628123456789" value="{{ old('no_wa', $profil->no_wa) }}"></div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <div class="input-group"><span class="input-group-text"><i class="bi bi-envelope-fill"></i></span><input type="email" id="email" name="email" class="form-control" value="{{ old('email', $profil->email) }}"></div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="instagram" class="form-label fw-bold">Instagram</label>
                    <div class="input-group"><span class="input-group-text">@</span><input type="text" id="instagram" name="instagram" class="form-control" placeholder="username" value="{{ old('instagram', $profil->instagram) }}"></div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="facebook" class="form-label fw-bold">Facebook</label>
                    <div class="input-group"><span class="input-group-text"><i class="bi bi-facebook"></i></span><input type="text" id="facebook" name="facebook" class="form-control" placeholder="username" value="{{ old('facebook', $profil->facebook) }}"></div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <label for="tiktok" class="form-label fw-bold">TikTok</label>
                    <div class="input-group"><span class="input-group-text"><i class="bi bi-tiktok"></i></span><input type="text" id="tiktok" name="tiktok" class="form-control" placeholder="@username" value="{{ old('tiktok', $profil->tiktok) }}"></div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
    <label for="youtube" class="form-label fw-bold">YouTube</label>
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-youtube"></i></span>
        <input type="url" id="youtube" name="youtube" class="form-control" placeholder="Link kanal YouTube" value="{{ old('youtube', $profil->youtube) }}">
    </div>
</div>
            </div>
            
        </div>
    </div>
</form>

{{-- SCRIPT JAVASCRIPT & STYLE (TIDAK BERUBAH) --}}
<style>
    .file-upload-wrapper { border: 2px dashed #E5E7EB; padding: 1.5rem; border-radius: 0.5rem; background-color: #F9FAFB; transition: background-color 0.2s ease; height: 100%; display: flex; flex-direction: column; justify-content: center; }
    .file-upload-wrapper:hover { background-color: #F3F4F6; }
</style>

<script>
    function updateMapPreview() {
        const addressInput = document.getElementById('alamat');
        const mapPreview = document.getElementById('mapPreview');
        const address = addressInput.value;
        mapPreview.src = `https://maps.google.com/maps?q=${encodeURIComponent(address)}&t=&z=15&ie=UTF8&iwloc=&output=embed`;
    }

    function previewLogo(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('logo-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection