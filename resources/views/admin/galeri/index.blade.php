@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')

{{-- Helper Function untuk ekstrak ID Video YouTube --}}
@php
function getYouTubeEmbedUrl($url) {
    if (preg_match('/(youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $match)) {
        return 'https://www.youtube.com/embed/' . $match[2];
    }
    return null;
}
@endphp

{{-- FORM TAMBAH / EDIT --}}
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">{{ isset($galeri_edit) ? 'Edit Galeri' : 'Tambah Galeri Baru' }}</h5>
    </div>
    <div class="card-body">
        <form id="galeri-form" action="{{ isset($galeri_edit) ? route('admin.galeri.update', $galeri_edit->id) : route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($galeri_edit))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $galeri_edit->judul ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5">{{ old('deskripsi', $galeri_edit->deskripsi ?? '') }}</textarea>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="tipe" class="form-label fw-bold">Tipe</label>
                        <select name="tipe" id="tipe" class="form-select" required onchange="toggleInput()">
                            <option value="foto" {{ old('tipe', $galeri_edit->tipe ?? 'foto') == 'foto' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ old('tipe', $galeri_edit->tipe ?? '') == 'video' ? 'selected' : '' }}>Video (YouTube)</option>
                        </select>
                    </div>

                    {{-- [BARU] Area Upload Foto dengan Preview --}}
                    <div class="mb-3" id="fotoInput">
                        <label class="form-label fw-bold">Upload Foto</label>
                        <div class="file-upload-wrapper text-center">
                            @php
                                $currentImage = (isset($galeri_edit) && $galeri_edit->tipe == 'foto')
                                                ? asset('storage/'.$galeri_edit->file)
                                                : 'https://via.placeholder.com/400x300.png?text=Pilih+Gambar';
                            @endphp
                            <img id="image-preview" src="{{ $currentImage }}" alt="Preview" class="img-fluid rounded mb-3" style="max-height: 150px; object-fit: contain;">
                            <input type="file" name="file_upload" id="image-input" class="d-none" onchange="previewImage(event)" accept="image/*">
                            <label for="image-input" class="btn btn-outline-primary w-100">
                                <i class="bi bi-upload me-2"></i> {{ isset($galeri_edit) && $galeri_edit->tipe == 'foto' ? 'Ubah Gambar' : 'Pilih Gambar' }}
                            </label>
                        </div>
                    </div>

                    {{-- Area Input Link Video --}}
                    <div class="mb-3" id="videoInput">
                        <label for="video_link" class="form-label fw-bold">Link Video YouTube</label>
                        <input type="url" name="video_link" id="video_link" class="form-control" placeholder="Tempel link YouTube di sini" value="{{ old('video_link', (isset($galeri_edit) && $galeri_edit->tipe == 'video') ? $galeri_edit->file : '') }}">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                @if(isset($galeri_edit))
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary me-2">Batal</a>
                @endif
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>
                    {{ isset($galeri_edit) ? 'Simpan Perubahan' : 'Tambah ke Galeri' }}
                </button>
            </div>
        </form>
    </div>
</div>

{{-- DAFTAR GALERI DALAM BENTUK GRID --}}
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Daftar Galeri</h5>
    </div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($galeris as $galeri)
                <div class="col">
                    <div class="card h-100">
                        @if($galeri->tipe == 'foto')
                            <img src="{{ asset('storage/' . $galeri->file) }}" class="card-img-top" alt="{{ $galeri->judul }}" style="height: 200px; object-fit: cover;">
                        @else
                            @php $embedUrl = getYouTubeEmbedUrl($galeri->file); @endphp
                            @if($embedUrl)
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $embedUrl }}" title="{{ $galeri->judul }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            @endif
                        @endif
                        <div class="card-body">
                            <h6 class="card-title fw-bold">{{ $galeri->judul }}</h6>
                            <p class="card-text small text-muted">{{ $galeri->deskripsi }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0 pb-3 text-end">
                            <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="d-inline form-hapus">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>Belum ada item di galeri.</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        {{ $galeris->links() }}
    </div>
</div>

<style>
    .file-upload-wrapper { border: 2px dashed #E5E7EB; padding: 1.5rem; border-radius: 0.5rem; background-color: #F9FAFB; transition: background-color 0.2s ease; }
    .file-upload-wrapper:hover { background-color: #F3F4F6; }
</style>

<script>
    // Fungsi untuk menampilkan/menyembunyikan input foto/video
    function toggleInput() {
        const tipe = document.getElementById('tipe').value;
        document.getElementById('fotoInput').style.display = tipe === 'foto' ? 'block' : 'none';
        document.getElementById('videoInput').style.display = tipe === 'video' ? 'block' : 'none';
    }

    // [BARU] Fungsi untuk preview gambar
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Panggil saat halaman dimuat untuk menyesuaikan dengan kondisi awal
    document.addEventListener('DOMContentLoaded', toggleInput);

    // Script SweetAlert untuk konfirmasi hapus
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({ title: 'Anda yakin?', text: "Item ini akan dihapus permanen!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal' })
                .then((result) => { if (result.isConfirmed) { this.submit(); } });
        });
    });
</script>
@endsection