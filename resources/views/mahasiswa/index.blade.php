@extends('layouts.app')

@section('title', 'Data Mahasiswa - Keamanan SI')

@section('content')
<!-- Page Header & Breadcrumb -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-dark mb-1">Manajemen Data Mahasiswa</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
            </ol>
        </nav>
    </div>
    
    @if(Auth::user()->role === 'admin')
        <!-- Tombol Tambah hanya untuk Admin -->
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary rounded-3 shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i> <span class="d-none d-md-inline">Tambah Mahasiswa</span>
        </a>
    @endif
</div>

<!-- Main Card / Table Container -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center gap-2">
        <i class="bi bi-table text-primary fs-5"></i>
        <h5 class="mb-0 fw-semibold">Daftar Mahasiswa Terdaftar</h5>
    </div>
    <div class="card-body p-0">
        <!-- Table Responsive Wrapper -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-4">NIM</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Program Studi / Jurusan</th>
                        <th scope="col">Alamat</th>
                        @if(Auth::user()->role === 'admin')
                            <th scope="col" class="text-center pe-4" style="width: 150px;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($mahasiswa as $mhs)
                        <tr>
                            <td class="ps-4 fw-semibold text-secondary">{{ $mhs->nim }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px; font-size: 0.9rem;">
                                        <!-- Menampilkan inisial nama -->
                                        {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                                    </div>
                                    <span class="fw-medium text-dark">{{ $mhs->nama }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-1 fw-medium">
                                    {{ $mhs->jurusan }}
                                </span>
                            </td>
                            <td class="text-muted small">{{ Str::limit($mhs->alamat, 50) }}</td>
                            
                            @if(Auth::user()->role === 'admin')
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-outline-warning btn-sm d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <!-- Tombol Hapus dengan form -->
                                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $mhs->nama }} (NIM: {{ $mhs->nim }})? Data yang dihapus tidak dapat dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role === 'admin' ? '5' : '4' }}" class="text-center py-5 text-muted">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <i class="bi bi-inbox fs-1 mb-3 text-secondary opacity-50"></i>
                                    <h5>Belum ada data mahasiswa</h5>
                                    @if(Auth::user()->role === 'admin')
                                        <p class="small mb-3">Silakan tambahkan data baru melalui tombol di atas.</p>
                                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-plus-circle"></i> Tambah Sekarang
                                        </a>
                                    @else
                                        <p class="small">Sistem belum memiliki data untuk ditampilkan saat ini.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Optional Table Footer (Bisa untuk Pagination nanti jika dibutuhkan) -->
    @if(count($mahasiswa) > 0)
        <div class="card-footer bg-light border-top py-3 px-4">
            <div class="text-muted small">
                Menampilkan total <strong>{{ count($mahasiswa) }}</strong> data mahasiswa.
            </div>
        </div>
    @endif
</div>

<!-- Script untuk mengaktifkan Tooltip Bootstrap (Opsional) -->
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection