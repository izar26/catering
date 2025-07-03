@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- Bagian Header Sambutan --}}
<div class="mb-4">
    <h4 class="fw-bold">Selamat Datang Kembali, Admin! 👋</h4>
    <p class="text-muted">Berikut adalah ringkasan aktivitas di website Anda.</p>
</div>

{{-- Baris untuk Kartu Statistik --}}
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-start border-primary border-4 shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Produk</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahProduk }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box-seam fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-start border-success border-4 shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Kategori</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahKategori }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-tags-fill fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-start border-info border-4 shadow-sm h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col me-2">
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">Total Testimoni</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahTestimoni }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-chat-left-quote-fill fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Baris untuk Widget Aktivitas Terbaru --}}
<div class="row">
    <div class="col-lg-7 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h6 class="m-0 fw-bold"><i class="bi bi-star-fill text-warning me-2"></i>Produk Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover mb-0">
                        <tbody>
                            @forelse ($produkTerbaru as $produk)
                            <tr>
                                <td class="ps-3"><img src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/80x80.png?text=N/A' }}" alt="{{ $produk->nama }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;"></td>
                                <td>
                                    <div class="fw-bold">{{ $produk->nama }}</div>
                                    <small class="text-muted">{{ $produk->kategori->nama }}</small>
                                </td>
                                <td class="text-end pe-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td class="text-center p-4">Belum ada produk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('admin.produk.index') }}" class="small">Lihat Semua Produk &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h6 class="m-0 fw-bold"><i class="bi bi-person-check-fill text-info me-2"></i>Testimoni Terbaru</h6>
            </div>
            <div class="list-group list-group-flush">
                @forelse ($testimoniTerbaru as $testimoni)
                <a href="{{ route('admin.testimoni.index') }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1 fw-bold">{{ $testimoni->nama }}</h6>
                        <small class="text-warning">
                            @for ($i = 1; $i <= $testimoni->rating; $i++) <i class="bi bi-star-fill"></i> @endfor
                        </small>
                    </div>
                    <p class="mb-1 small text-muted">"{{ Str::limit($testimoni->isi, 80) }}"</p>
                </a>
                @empty
                <div class="list-group-item text-center p-4">Belum ada testimoni.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection