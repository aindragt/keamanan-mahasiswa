@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-5">
                
                <!-- Header & Icon -->
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 65px; height: 65px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.2 7.2 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5"/>
                        </svg>
                    </div>
                    <h3 class="fw-bold text-dark">Selamat Datang</h3>
                    <p class="text-muted">Silakan login untuk mengakses sistem keamanan</p>
                </div>

                <!-- Notifikasi Error -->
                @if($errors->any())
                    <div class="alert alert-danger rounded-3 alert-dismissible fade show shadow-sm" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <!-- Tombol silang untuk menutup notifikasi -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Form Login -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf <!-- PROTEKSI CSRF WAJIB -->
                    
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control rounded-3" id="floatingEmail" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="floatingEmail" class="text-muted">Alamat Email</label>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword" class="text-muted">Password</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 shadow-sm fw-bold">Login Masuk</button>
                </form>

                <!-- Link ke Halaman Registrasi -->
                <div class="text-center mt-4">
                    <p class="text-muted small">Belum punya akun? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Daftar sekarang</a></p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection