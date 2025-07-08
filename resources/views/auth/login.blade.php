<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Cetring</title>
    
    <link href="{{ asset('storage/' . $profil->logo) }}" rel="icon">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 900px;
            min-height: 550px;
            display: flex;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        }
        .branding-panel {
            flex: 1;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1887&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
        }
        .branding-panel h1 {
            font-weight: 700;
            font-size: 2.5rem;
        }
        .form-panel {
            flex: 1;
            background: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .input-group-text {
            background-color: #e9ecef;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }
        @media (max-width: 768px) {
            .branding-panel { display: none; }
            .form-panel { padding: 2rem; }
            .login-container { min-height: auto; box-shadow: none; }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="branding-panel">
            <h1>{{ $profil->nama_perusahaan}}</h1>
            <p>Selamat Datang di Panel Admin</p>
        </div>

        <div class="form-panel">
            <h3 class="fw-bold mb-4">Login ke Akun Anda</h3>
            <form method="POST" action="/login">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                
                {{-- Notifikasi alert lama dihapus dari sini --}}
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        @if ($errors->any())
            Toastify({
                text: "Username atau password yang Anda masukkan salah.",
                duration: 4000,
                close: true,
                gravity: "top", 
                position: "right", 
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #d32f2f, #e57373)",
                }
            }).showToast();
        @endif
    </script>

</body>
</html>