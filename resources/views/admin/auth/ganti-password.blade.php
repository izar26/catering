@extends('layouts.admin')

@section('title', 'Ganti Password')

@section('content')

{{-- Layout untuk menempatkan card di tengah halaman --}}
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-key-fill me-2"></i>Ganti Password Anda</h5>
            </div>
            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf
                <div class="card-body">
                    {{-- Password Lama --}}
                    <div class="mb-3">
                        <label for="password_lama" class="form-label fw-bold">Password Lama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password_lama" id="password_lama" class="form-control" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_lama', this)">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('password_lama') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label for="password_baru" class="form-label fw-bold">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" name="password_baru" id="password_baru" class="form-control" required>
                             <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_baru', this)">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('password_baru') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    {{-- Konfirmasi Password Baru --}}
                    <div class="mb-3">
                        <label for="password_baru_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" name="password_baru_confirmation" id="password_baru_confirmation" class="form-control" required>
                             <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_baru_confirmation', this)">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Ganti Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Script untuk fitur tampilkan/sembunyikan password --}}
<script>
function togglePassword(inputId, button) {
    const passwordInput = document.getElementById(inputId);
    const icon = button.querySelector('i');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        passwordInput.type = "password";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}
</script>

@endsection