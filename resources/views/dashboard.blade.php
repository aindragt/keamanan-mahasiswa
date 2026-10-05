@extends('layouts.app')

@section('title', 'Dashboard Utama - Keamanan SI')

@section('content')
<!-- Hero Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge bg-white text-primary mb-3 px-3 py-2 fw-semibold rounded-pill shadow-sm">
                            <i class="bi bi-shield-check me-1"></i> Sesi Terautentikasi
                        </span>
                        <h2 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="mb-0 text-white-50">
                            Anda masuk dengan hak akses sebagai 
                            <span class="badge bg-warning text-dark fw-bold ms-1">{{ strtoupper(Auth::user()->role) }}</span>
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0 d-none d-md-block opacity-75">
                        <i class="bi bi-person-badge display-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grid Menu & Informasi -->
<div class="row g-4">
    <!-- Card Module Data Mahasiswa -->
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-semibold">Modul Data</span>
                        <div class="bg-primary-subtle text-primary p-3 rounded-4">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Data Mahasiswa</h5>
                    <p class="text-muted small">
                        Kelola data akademik mahasiswa secara terpusat dengan dukungan validasi data dan proteksi keamanan.
                    </p>
                </div>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary rounded-3 w-100 fw-semibold d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-folder2-open"></i> Buka Data Mahasiswa
                </a>
            </div>
        </div>
    </div>

    <!-- Card Audit Log / Informasi Role -->
    @if(Auth::user()->role === 'admin')
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small fw-semibold">Fitur Khusus Admin</span>
                            <div class="bg-warning-subtle text-warning p-3 rounded-4">
                                <i class="bi bi-journal-text fs-3"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Audit Log Aktivitas</h5>
                        <p class="text-muted small">
                            Pantau riwayat login, logout, dan tindakan CRUD pengguna untuk kebutuhan pengawasan keamanan.
                        </p>
                    </div>
                    <a href="{{ route('audit.logs') }}" class="btn btn-warning rounded-3 w-100 fw-semibold d-flex align-items-center justify-content-center gap-2 text-dark">
                        <i class="bi bi-shield-lock"></i> Lihat Audit Log
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small fw-semibold">Hak Akses Pengguna</span>
                            <div class="bg-info-subtle text-info p-3 rounded-4">
                                <i class="bi bi-eye-fill fs-3"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Akses Read-Only</h5>
                        <p class="text-muted small">
                            Akun Anda terdaftar sebagai **User biasa**. Anda hanya diizinkan untuk melihat data tanpa mengubah atau menghapusnya.
                        </p>
                    </div>
                    <button class="btn btn-outline-secondary rounded-3 w-100 fw-semibold" disabled>
                        <i class="bi bi-lock-fill me-1"></i> Mode Baca Saja
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Card Status Fitur Keamanan -->
    <div class="col-md-12 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-semibold">Sistem Keamanan</span>
                    <div class="bg-success-subtle text-success p-3 rounded-4">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-3">Status Proteksi</h5>
                <ul class="list-unstyled mb-0 small">
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Proteksi CSRF Token Form
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Password Hashing Bcrypt
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Middleware Proteksi Route
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Throttle Rate Limiting
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection