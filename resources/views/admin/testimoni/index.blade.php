@extends('layouts.admin')

@section('title', 'Manajemen Testimoni')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">{{ isset($testimoni_edit) ? 'Edit Testimoni' : 'Tambah Testimoni Baru' }}</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 ps-3">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                    </div>
                @endif
                
                <form action="{{ isset($testimoni_edit) ? route('admin.testimoni.update', $testimoni_edit->id) : route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($testimoni_edit))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold">Foto (Opsional)</label>
                        @if(isset($testimoni_edit) && $testimoni_edit->foto)
                            <img src="{{ asset('storage/'.$testimoni_edit->foto) }}" class="d-block img-thumbnail mb-2" style="max-height: 100px;">
                        @endif
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Pelanggan</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $testimoni_edit->nama ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="aktor" class="form-label fw-bold">Aktor/Profesi</label>
                        <input type="text" name="aktor" id="aktor" class="form-control" value="{{ old('aktor', $testimoni_edit->aktor ?? '') }}" placeholder="Contoh: Ibu Rumah Tangga, Karyawan">
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label fw-bold">Isi Testimoni</label>
                        <textarea name="isi" id="isi" class="form-control" rows="4" required>{{ old('isi', $testimoni_edit->isi ?? '') }}</textarea>
                    </div>


                    <div class="mb-3">
                        <label for="rating" class="form-label fw-bold">Rating</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="" disabled {{ !isset($testimoni_edit) ? 'selected' : '' }}>-- Beri Rating --</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimoni_edit->rating ?? '') == $i ? 'selected' : '' }}>
                                    {{ $i }} Bintang
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="tampilkan" role="switch" id="tampilkan" value="1" {{ old('tampilkan', $testimoni_edit->tampilkan ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tampilkan">Tampilkan di Halaman Depan</label>
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary w-100">{{ isset($testimoni_edit) ? 'Simpan Perubahan' : 'Tambah Testimoni' }}</button>
                        @if(isset($testimoni_edit))
                            <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary ms-2">Batal</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Daftar Testimoni</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Pelanggan</th>
                                <th>Isi Testimoni</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonis as $testimoni)
                                <tr>
                                    <td style="min-width: 200px;">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $testimoni->foto ? asset('storage/'.$testimoni->foto) : 'https://via.placeholder.com/100.png?text=N/A' }}" alt="{{ $testimoni->nama }}" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold">{{ $testimoni->nama }}</div>
                                                <small class="text-muted">{{ $testimoni->aktor }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($testimoni->isi, 70) }}</td>
                                    <td class="text-center text-warning" style="min-width: 120px;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $testimoni->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </td>
                                    <td class="text-center">
                                        @if($testimoni->tampilkan)
                                            <span class="badge bg-success-subtle text-success-emphasis">Ditampilkan</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger-emphasis">Disembunyikan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.testimoni.edit', $testimoni) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('admin.testimoni.destroy', $testimoni) }}" method="POST" class="d-inline form-hapus">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada data testimoni.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $testimonis->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({ title: 'Anda yakin?', text: "Testimoni ini akan dihapus!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, hapus!', cancelButtonText: 'Batal' })
                    .then((result) => { if (result.isConfirmed) { this.submit(); } });
            });
        });
    });
</script>
@endsection