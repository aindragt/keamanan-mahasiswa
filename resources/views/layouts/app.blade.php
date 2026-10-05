<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Data Mahasiswa - Keamanan SI')</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        main {
            flex: 1; /* Memastikan footer selalu di bawah */
        }
        .footer {
            background-color: #ffffff;
            border-top: 1px solid #e9ecef;
            padding: 1rem 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <i class="bi bi-shield-lock-fill text-primary"></i>
                <span>Keamanan SI</span>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item me-3 mb-2 mb-lg-0">
                            <span class="nav-link text-light d-flex align-items-center gap-2">
                                <i class="bi bi-person-circle fs-5"></i>
                                <span>
                                    {{ Auth::user()->name }} 
                                    <span class="badge bg-primary ms-1">{{ strtoupper(Auth::user()->role) }}</span>
                                </span>
                            </span>
                        </li>
                        
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item me-2 mb-2 mb-lg-0">
                                <a class="btn btn-outline-warning btn-sm d-flex align-items-center gap-1" href="{{ route('audit.logs') }}">
                                    <i class="bi bi-journal-text"></i> Audit Log
                                </a>
                            </li>
                        @endif
                        
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm d-flex align-items-center gap-1 shadow-sm w-100" type="submit">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="container py-4">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dynamic Content -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer text-center text-muted">
        <div class="container">
            <small>&copy; {{ date('Y') }} Sistem Data Mahasiswa - Keamanan Sistem Informasi. All rights reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS (Membutuhkan Popper.js untuk dropdown, collapse, dan alert dismiss) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>