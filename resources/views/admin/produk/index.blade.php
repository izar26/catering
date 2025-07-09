@extends('layouts.admin')

@section('title', 'Produk')

@section('content')

{{-- Notifikasi Toastify akan ditangani oleh layout utama jika ada session 'success' --}}

<div class="card shadow-sm">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-gray-800">Data Produk</h5>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dt" class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Tipe</th>
                        <th scope="col" class="text-center" title="Unggulan"><i class="bi bi-star-fill"></i></th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/80x80.png?text=No+Image' }}" alt="{{ $produk->nama }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td class="fw-bold">{{ $produk->nama }}</td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis">{{ $produk->kategori->nama }}</span>
                            </td>
                            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $produk->tipe == 'satuan' ? 'bg-primary-subtle text-primary-emphasis' : 'bg-info-subtle text-info-emphasis' }}">{{ ucfirst($produk->tipe) }}</span>
                            </td>
                            <td class="text-center">
                                @if($produk->is_unggulan)
                                    <i class="bi bi-star-fill text-warning" title="Produk Unggulan"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" class="d-inline form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash3-fill"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="mb-0">Belum ada data produk.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SCRIPT SWEETALERT KITA TARUH DI SINI, DI DALAM SECTION 'CONTENT' --}}
<script>
    // Pastikan DOM sudah dimuat sebelum menjalankan script
    document.addEventListener('DOMContentLoaded', function () {
        // Menargetkan semua form dengan class 'form-hapus'
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Mencegah form dikirim langsung
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data produk yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, kirim form
                        this.submit();
                    }
                });
            });
        });
    });
</script>

@endsection