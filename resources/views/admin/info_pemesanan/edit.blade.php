@extends('layouts.admin')

@section('title', 'Pengaturan Info Pemesanan')

@section('content')

<form action="{{ route('admin.info.pemesanan.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Pengaturan Info Pemesanan</h4>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>
            Simpan Semua Perubahan
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="infoTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pengiriman-tab" data-bs-toggle="tab" data-bs-target="#pengiriman-pane" type="button" role="tab">Pengiriman</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pembayaran-tab" data-bs-toggle="tab" data-bs-target="#pembayaran-pane" type="button" role="tab">Pembayaran</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pembatalan-tab" data-bs-toggle="tab" data-bs-target="#pembatalan-pane" type="button" role="tab">Pembatalan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="harga-tab" data-bs-toggle="tab" data-bs-target="#harga-pane" type="button" role="tab">Harga & Biaya</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="infoTabContent">
                <div class="tab-pane fade show active" id="pengiriman-pane" role="tabpanel">
                    <label for="info_pengiriman" class="form-label fw-bold">Teks Kebijakan Pengiriman</label>
                    {{-- Menggunakan textarea biasa dengan atribut rows --}}
                    <textarea name="info_pengiriman" id="info_pengiriman" class="form-control" rows="12">{{ old('info_pengiriman', $info->info_pengiriman) }}</textarea>
                </div>
                <div class="tab-pane fade" id="pembayaran-pane" role="tabpanel">
                    <label for="info_pembayaran" class="form-label fw-bold">Teks Kebijakan Pembayaran</label>
                    <textarea name="info_pembayaran" id="info_pembayaran" class="form-control" rows="12">{{ old('info_pembayaran', $info->info_pembayaran) }}</textarea>
                </div>
                <div class="tab-pane fade" id="pembatalan-pane" role="tabpanel">
                    <label for="info_pembatalan" class="form-label fw-bold">Teks Kebijakan Pembatalan</label>
                    <textarea name="info_pembatalan" id="info_pembatalan" class="form-control" rows="12">{{ old('info_pembatalan', $info->info_pembatalan) }}</textarea>
                </div>
                <div class="tab-pane fade" id="harga-pane" role="tabpanel">
                    <label for="info_harga" class="form-label fw-bold">Teks Kebijakan Harga & Biaya</label>
                    <textarea name="info_harga" id="info_harga" class="form-control" rows="12">{{ old('info_harga', $info->info_harga) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- TIDAK ADA LAGI SCRIPT TINYMCE DI SINI --}}

@endsection