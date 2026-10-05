<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index() {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create() {
        return view('mahasiswa.create');
    }

    public function store(Request $request) {
        // Validasi Input Server-Side
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
        ]);

        $mhs = Mahasiswa::create($request->all());

        // Audit Log
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'CREATE_MAHASISWA',
            'ip_address' => $request->ip(),
            'details' => 'Menambahkan mahasiswa NIM: ' . $mhs->nim
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa) {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa) {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
        ]);

        $mahasiswa->update($request->all());

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'UPDATE_MAHASISWA',
            'ip_address' => $request->ip(),
            'details' => 'Mengubah data mahasiswa ID: ' . $mahasiswa->id
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa, Request $request) {
        $nim = $mahasiswa->nim;
        $mahasiswa->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'DELETE_MAHASISWA',
            'ip_address' => $request->ip(),
            'details' => 'Menghapus data mahasiswa NIM: ' . $nim
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}