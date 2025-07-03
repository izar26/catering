@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Formulir Edit Produk: {{ $produk->nama }}</h5>
    </div>
    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6 class="alert-heading">Terdapat kesalahan:</h6>
                    <ul class="mb-0 ps-3">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pesan_wa" class="form-label fw-bold">Teks Tombol Pesan WA (Opsional)</label>
                        <textarea name="pesan_wa" id="pesan_wa" class="form-control" rows="3">{{ old('pesan_wa', $produk->pesan_wa) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label fw-bold">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="tipe" class="form-label fw-bold">Tipe Produk</label>
                        <select name="tipe" id="tipe" class="form-select" required>
                            <option value="satuan" {{ old('tipe', $produk->tipe) == 'satuan' ? 'selected' : '' }}>Satuan</option>
                            <option value="paketan" {{ old('tipe', $produk->tipe) == 'paketan' ? 'selected' : '' }}>Paketan</option>
                            <option value="prevent" {{ old('tipe', $produk->tipe) == 'prevent' ? 'selected' : '' }}>Pre-order</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga" class="form-label fw-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $produk->harga) }}" required min="0">
                        </div>
                    </div>
    
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_unggulan" role="switch" id="is_unggulan" value="1" {{ old('is_unggulan', $produk->is_unggulan) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_unggulan">Jadikan Produk Unggulan</label>
                    </div>
                </div>

                <div class="col-md-4">
                    {{-- [DIPINDAH KE ATAS] --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar Utama</label>
                        <div class="file-upload-wrapper text-center">
                            <img id="image-preview" src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/400x300.png?text=Pilih+Gambar' }}" alt="Image preview" class="img-fluid rounded mb-3" style="max-height: 180px; object-fit: contain;">
                            <input type="file" name="gambar" id="image-input" class="d-none" onchange="previewImage(event)" accept="image/*">
                            <label for="image-input" class="btn btn-outline-primary w-100"><i class="bi bi-upload me-2"></i>Ubah Gambar</label>
                            <div class="form-text mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan Perubahan</button>
        </div>
    </form>
</div>

{{-- SCRIPT & STYLE --}}
<style>
    .file-upload-wrapper { border: 2px dashed #E5E7EB; padding: 1.5rem; border-radius: 0.5rem; background-color: #F9FAFB; transition: background-color 0.2s ease; }
    .file-upload-wrapper:hover { background-color: #F3F4F6; }
</style>

<script>
    tinymce.init({
        selector: 'textarea#deskripsi',
        plugins: 'lists link image media table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
    });

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