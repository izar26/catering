@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Formulir Tambah Produk</h5>
    </div>
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6 class="alert-heading">Terdapat kesalahan:</h6>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Contoh: Nasi Box Ayam Bakar">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control editor">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="pesan_wa" class="form-label fw-bold">Teks Tombol Pesan WA (Opsional)</label>
                        <textarea name="pesan_wa" id="pesan_wa" class="form-control" rows="3" placeholder="Teks ini akan otomatis dikirim saat pelanggan menekan tombol order di halaman produk.">{{ old('pesan_wa') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipe" class="form-label fw-bold">Tipe Produk</label>
                        <select name="tipe" id="tipe" class="form-select" required>
                            <option value="satuan" {{ old('tipe') == 'satuan' ? 'selected' : '' }}>Satuan</option>
                            <option value="paketan" {{ old('tipe') == 'paketan' ? 'selected' : '' }}>Paketan</option>
                            <option value="prevent" {{ old('tipe') == 'prevent' ? 'selected' : '' }}>Pre-event</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label fw-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required min="0" placeholder="25000">
                        </div>
                    </div>
                    
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_unggulan" role="switch" id="is_unggulan" value="1" {{ old('is_unggulan') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_unggulan">Jadikan Produk Unggulan</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar Utama</label>
                        <div class="file-upload-wrapper text-center">
                            <img id="image-preview" src="https://via.placeholder.com/400x300.png?text=Pilih+Gambar" alt="Image preview" class="img-fluid rounded mb-3" style="max-height: 180px; object-fit: contain;">
                            <input type="file" name="gambar" id="image-input" class="d-none" onchange="previewImage(event)" accept="image/*">
                            <label for="image-input" class="btn btn-outline-primary w-100">
                                <i class="bi bi-upload me-2"></i>Pilih File Gambar
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i>
                Simpan Produk
            </button>
        </div>
    </form>
</div>

{{-- SCRIPT & STYLE --}}
<style>
    .file-upload-wrapper { border: 2px dashed #E5E7EB; padding: 1.5rem; border-radius: 0.5rem; background-color: #F9FAFB; transition: background-color 0.2s ease; }
    .file-upload-wrapper:hover { background-color: #F3F4F6; }
</style>

<script>
    // Inisialisasi TinyMCE untuk deskripsi
    tinymce.init({
        selector: 'textarea.editor', // Targetkan textarea dengan class 'editor'
        plugins: 'lists link image media table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });

    // Fungsi untuk preview gambar
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection