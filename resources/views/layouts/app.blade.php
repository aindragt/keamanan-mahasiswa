<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Data Mahasiswa - Keamanan SI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Keamanan Sistem Informasi</a>
            <div class="navbar-nav ms-auto">
                @auth
                    <span class="nav-link text-white me-3">Login sebagai: <strong>{{ Auth::user()->name }} ({{ strtoupper(Auth::user()->role) }})</strong></span>
                    @if(Auth::user()->role === 'admin')
                        <a class="nav-link text-warning me-2" href="{{ route('audit.logs') }}">Audit Log</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf <!-- Proteksi CSRF pada Form Logout -->
                        <button class="btn btn-sm btn-outline-danger" type="submit">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>