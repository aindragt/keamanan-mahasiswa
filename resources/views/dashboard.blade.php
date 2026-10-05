@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h4>Dashboard Utama</h4>
    </div>
    <div class="card-body">
        <h5>Selamat datang, {{ Auth::user()->name }}!</h5>
        <p>Anda login dengan hak akses sebagai: <span class="badge bg-primary">{{ strtoupper(Auth::user()->role) }}</span></p>
        
        <hr>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-info text-white">Lihat Data Mahasiswa</a>
    </div>
</div>
@endsection