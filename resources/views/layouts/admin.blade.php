<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('storage/' . $profil->logo) }}" rel="icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        /* === CUSTOM VARIABLES - TEMA CERAH (LIGHT THEME) === */
        :root {
            --sidebar-bg: #FFFFFF; /* Sidebar sekarang putih */
            --content-bg: #F9FAFB; /* Latar belakang konten abu-abu sangat muda */
            --card-bg: #FFFFFF;
            --text-primary: #1F2937; /* Teks utama lebih gelap */
            --text-secondary: #6B7280; /* Teks sekunder (link sidebar) */
            --border-color: #E5E7EB;
            --accent-color: #4F46E5; /* Biru Indigo yang vibrant sebagai aksen */
        }

        /* === BASE STYLES === */
        body {
            background-color: var(--content-bg);
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter, sangat bersih! */
            color: var(--text-primary);
        }

        a {
            text-decoration: none;
        }
        
        /* === SIDEBAR STYLES - LIGHT VERSION === */
        .sidebar {
        width: 260px;
        background-color: var(--sidebar-bg);
        border-right: 1px solid var(--border-color);
        transition: transform 0.3s ease-in-out;
        z-index: 1030;
        flex-shrink: 0; /* Mencegah sidebar menyusut */
        
        /* [BARU] Kunci agar sidebar tetap diam */
        position: sticky;
        top: 0;
        height: 100vh;
    }

        .sidebar .brand {
            padding: 1.5rem;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }
        .sidebar .brand i {
            color: var(--accent-color);
            margin-right: 12px;
        }

        .sidebar-nav {
            padding: 1rem 0.75rem;
        }

        .sidebar-nav .nav-link {
            color: var(--text-secondary);
            font-weight: 500;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            border-radius: 0.375rem;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
        }

        .sidebar-nav .nav-link i {
            margin-right: 1rem;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
            color: #9CA3AF;
            transition: color 0.2s ease;
        }
        
        .sidebar-nav .nav-link span {
            /* Sedikit penyesuaian agar posisi rapi */
            transform: translateY(1px);
        }

        .sidebar-nav .nav-link:hover {
            background-color: #F3F4F6; /* Latar abu-abu saat di-hover */
            color: var(--text-primary);
        }
        
        .sidebar-nav .nav-link:hover i {
            color: var(--text-primary);
        }

        .sidebar-nav .nav-link.active {
            background-color: var(--accent-color);
            color: #FFFFFF; /* Teks putih saat aktif */
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .sidebar-nav .nav-link.active i {
            color: #FFFFFF;
        }

        /* === MAIN CONTENT STYLES === */
        .content-wrapper {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        
        /* [BARU] Kunci agar konten bisa di-scroll independen */
        height: 100vh;
        overflow-y: auto;
    }

        .top-navbar {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 2rem;
            height: 65px; /* Tinggi navbar yang konsisten */

            position: sticky;
        top: 0;
        z-index: 1020; /* Pastikan z-index di bawah sidebar */
        }
        
        .main-content {
            padding: 2rem; /* Padding lebih besar agar lebih lega */
            flex-grow: 1;
        }
        
        .card {
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05); /* Shadow lebih halus */
        }
        .card-header {
             background-color: transparent;
             border-bottom: 1px solid var(--border-color);
             padding: 1rem 1.5rem;
             font-weight: 600;
             font-size: 1.1rem;
        }
        .card-body {
            padding: 1.5rem;
        }

        /* === RESPONSIVE & TOGGLE === */
        .sidebar-toggle {
            cursor: pointer;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .sidebar {
            position: fixed; 
            transform: translateX(-100%);
        }
            .sidebar.show {
                transform: translateX(0);
                box-shadow: 0 0 40px rgba(0,0,0,0.1);
            }
            .content-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background-color: rgba(0,0,0,0.2); /* Overlay lebih transparan */
                z-index: 1029;
            }
            .content-overlay.active {
                display: block;
            }
            .main-content {
                padding: 1.5rem;
            }
            .top-navbar {
                padding: 0.75rem 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar flex-shrink-0" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span>CETRING</span>
        </a>

        <nav class="sidebar-nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.profil.edit') }}" class="nav-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> <span>Profil Usaha</span>
            </a>
            <a href="{{ route('admin.info.pemesanan.edit') }}" class="nav-link {{ request()->routeIs('admin.info.pemesanan.*') ? 'active' : '' }}">
    <i class="bi bi-info-circle-fill"></i> <span>Info Pemesanan</span>
</a>
            <a href="{{ route('admin.produk.index') }}" class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> <span>Produk</span>
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> <span>Kategori</span>
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> <span>Galeri</span>
            </a>
            <a class="nav-link {{ request()->is('admin/testimoni*') ? 'active' : '' }}" href="{{ route('admin.testimoni.index') }}">
                <i class="bi bi-chat-left-text"></i> <span>Testimoni</span>
            </a>
        </nav>
    </div>

    <div class="content-overlay" id="overlay" onclick="toggleSidebar()"></div>

    <div class="content-wrapper">
        <nav class="top-navbar d-flex justify-content-between align-items-center">
            <i class="bi bi-list sidebar-toggle d-md-none" onclick="toggleSidebar()"></i>
            
            <h5 class="mb-0 fw-bold d-none d-md-block text-secondary">@yield('title', 'Dashboard')</h5>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>Halo, Admin</strong>
                    {{-- <img src="https://via.placeholder.com/100" alt="foto profil" width="32" height="32" class="rounded-circle ms-2"> --}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small shadow border-0" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="{{ route('admin.password.form') }}">Ganti Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</div>

<script src="/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
 <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 
 <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function () {
        $('#dt').DataTable();
    });
</script>
    @stack('scripts')
<script>
        @if(session('success'))
            Toastify({ text: "{{ session('success') }}", duration: 3000, close: true, gravity: "top", position: "right", backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)" }).showToast();
        @elseif(session('error'))
            Toastify({ text: "{{ session('error') }}", duration: 3000, close: true, gravity: "top", position: "right", backgroundColor: "linear-gradient(to right, #e85858, #c94040)" }).showToast();
        @endif
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('overlay').classList.toggle('active');
    }
</script>
</body>
</html>