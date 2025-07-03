@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">{{ isset($kategori_edit) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- Ini adalah form untuk Tambah atau Update --}}
                <form action="{{ isset($kategori_edit) ? route('admin.kategori.update', $kategori_edit->id) : route('admin.kategori.store') }}" method="POST">
                    @csrf
                    @if(isset($kategori_edit))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Kategori</label>
                        <input type="text" name="nama" id="nama" class="form-control" 
                               value="{{ old('nama', $kategori_edit->nama ?? '') }}" 
                               placeholder="Contoh: Nasi Box" required>
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ isset($kategori_edit) ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                        </button>
                        @if(isset($kategori_edit))
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary ms-2">Batal</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 text-gray-800">Daftar Kategori</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold">{{ $kategori->nama }}</td>
                                    <td>{{ $kategori->slug }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        {{-- Ini adalah form khusus untuk Hapus --}}
                                        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash3-fill"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada data kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk konfirmasi hapus dengan SweetAlert --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>
@endsection