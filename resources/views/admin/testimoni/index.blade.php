@extends('layouts.admin')

@section('title', 'Manajemen Testimoni')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Daftar Testimoni</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Nomor HP</th>
                        <th>Isi Testimoni</th>
                        <th class="text-center">Rating</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonis as $testimoni)
                        <tr>
                            <td>
                                {{ ($testimonis->currentPage() - 1) * $testimonis->perPage() + $loop->iteration }}
                            </td>
                            <td style="min-width: 200px;">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $testimoni->foto ? asset('storage/'.$testimoni->foto) : 'https://via.placeholder.com/100.png?text=N/A' }}" alt="{{ $testimoni->nama }}" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold">{{ $testimoni->nama }}</div>
                                        <small class="text-muted">{{ $testimoni->aktor }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $testimoni->nomor_hp ?? '-' }}</td>
                            <td>{{ $testimoni->isi }}</td>
                            <td class="text-center text-warning" style="min-width: 120px;">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $testimoni->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </td>
                            <td class="text-center">
    <div class="form-check form-switch d-flex justify-content-center">
        <input class="form-check-input toggle-tampilkan" 
               type="checkbox" 
               data-id="{{ $testimoni->id }}" 
               {{ $testimoni->tampilkan ? 'checked' : '' }}>
    </div>
</td>

                            <td class="text-center">
                                <form action="{{ route('admin.testimoni.destroy', $testimoni) }}" method="POST" class="d-inline form-hapus">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data testimoni.</td>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // konfirmasi hapus
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Testimoni ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });

    // toggle tampilkan
    document.querySelectorAll('.toggle-tampilkan').forEach(switchEl => {
        switchEl.addEventListener('change', function () {
            const testimoniId = this.dataset.id;
            const tampilkan = this.checked ? 1 : 0;

            fetch(`/admin/testimoni/${testimoniId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ tampilkan })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // optionally, show a success toast
                    console.log('Status diperbarui.');
                } else {
                    alert('Gagal mengubah status.');
                }
            })
            .catch(err => {
                alert('Terjadi kesalahan.');
                console.error(err);
            });
        });
    });
});
</script>

@endsection
