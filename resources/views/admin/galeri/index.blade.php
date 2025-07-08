@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
@php
function getYouTubeEmbedUrl($url) {
    if (preg_match('/(youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $match)) {
        return 'https://www.youtube.com/embed/' . $match[2];
    }
    return null;
}
@endphp

{{-- FORM --}}
<div class="card shadow-sm mb-4">
    <div class="card-header"><h5>{{ isset($galeri_edit) ? 'Edit Galeri' : 'Tambah Galeri Baru' }}</h5></div>
    <div class="card-body">
        <form action="{{ isset($galeri_edit) ? route('admin.galeri.update', $galeri_edit->id) : route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf @if(isset($galeri_edit)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-7">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri_edit->judul ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $galeri_edit->deskripsi ?? '') }}</textarea>
                    </div>
                    @php
    $defaultStatus = old('status', isset($galeri_edit) ? $galeri_edit->status : false);
@endphp

<div class="form-check form-switch mt-2">
    <input type="hidden" name="status" value="0"> {{-- Supaya tetap terkirim kalau checkbox dimatikan --}}
    <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ $defaultStatus ? 'checked' : '' }}>
    <label class="form-check-label" for="status">Tampilkan di Halaman Depan</label>
</div>

                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipe</label>
                        <select name="tipe" class="form-select" id="tipe" onchange="toggleInput()">
                            <option value="foto" {{ old('tipe', $galeri_edit->tipe ?? 'foto') == 'foto' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ old('tipe', $galeri_edit->tipe ?? '') == 'video' ? 'selected' : '' }}>Video (YouTube)</option>
                        </select>
                    </div>
                    <div id="fotoInput" class="mb-3">
                        <label class="form-label fw-bold">Upload Foto</label>
                        @php
                            $currentImage = (isset($galeri_edit) && $galeri_edit->tipe == 'foto' && $galeri_edit->file)
                                ? asset('storage/'.$galeri_edit->file)
                                : asset('img/placeholder-galeri.png');
                        @endphp
                        <div class="file-upload-wrapper text-center">
                            <img id="image-preview" src="{{ $currentImage }}" class="img-fluid rounded mb-2" style="max-height: 150px; object-fit: contain;">
                            <input type="file" name="file_upload" id="image-input" class="d-none" accept="image/*" onchange="previewImage(event)">
                            <label for="image-input" class="btn btn-outline-primary w-100"><i class="bi bi-upload me-2"></i> Pilih Gambar</label>
                        </div>
                    </div>
                    <div id="videoInput" class="mb-3">
                        <label class="form-label fw-bold">Link Video YouTube</label>
                        <input type="url" name="video_link" class="form-control"
    placeholder="https://youtube.com/..."
    value="{{ old('video_link', (isset($galeri_edit) && $galeri_edit->tipe === 'video') ? $galeri_edit->file : '') }}">

                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                @if(isset($galeri_edit))
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary me-2">Batal</a>
                @endif
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- CARI --}}
<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Cari judul..." value="{{ request('q') }}">
        <button class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
    </div>
</form>

{{-- TABS --}}
<ul class="nav nav-tabs mb-3" id="galeriTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#foto">Foto</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#video">Video</a></li>
</ul>

<div class="tab-content">
    @foreach (['foto', 'video'] as $type)
    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $type }}">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($galeris->where('tipe', $type) as $galeri)
                <div class="col">
                    <div class="card h-100">
                        @if($galeri->tipe == 'foto')
                            <img src="{{ asset('storage/' . $galeri->file) }}" class="card-img-top" alt="{{ $galeri->judul }}" style="height: 200px; object-fit: cover;">
                        @else
                            @php $embedUrl = getYouTubeEmbedUrl($galeri->file); @endphp
                            @if($embedUrl)
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $embedUrl }}" title="{{ $galeri->judul }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @endif
                        @endif
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">{{ $galeri->judul }}</h6>
                            <p class="text-muted small">{{ $galeri->deskripsi }}</p>
                            <span class="badge bg-{{ $galeri->status ? 'success' : 'secondary' }}">{{ $galeri->status ? 'Ditampilkan' : 'Disembunyikan' }}</span>
                        </div>
                        <div class="card-footer text-end bg-white border-top-0 pb-3">
<a href="{{ route('admin.galeri.index', ['edit' => $galeri->id]) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="d-inline form-hapus">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4"><em>Tidak ada data {{ $type }}.</em></div>
            @endforelse
        </div>
    </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $galeris->appends(['q' => request('q')])->links() }}
</div>

<style>
.file-upload-wrapper { border: 2px dashed #E5E7EB; padding: 1.5rem; border-radius: 0.5rem; background-color: #F9FAFB; }
.file-upload-wrapper:hover { background-color: #F3F4F6; }
</style>

<script>
function toggleInput() {
    const tipe = document.getElementById('tipe').value;
    document.getElementById('fotoInput').style.display = tipe === 'foto' ? 'block' : 'none';
    document.getElementById('videoInput').style.display = tipe === 'video' ? 'block' : 'none';
}
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = () => document.getElementById('image-preview').src = reader.result;
    reader.readAsDataURL(event.target.files[0]);
}
document.addEventListener('DOMContentLoaded', toggleInput);
</script>
@endsection
