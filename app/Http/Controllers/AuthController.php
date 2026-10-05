<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // Validasi Server-Side
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // FITUR BONUS: Throttle Login Attempt (Max 5 percobaan per menit)
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors(['email' => "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik."]);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate(); // Mencegah Session Fixation Attack

            // FITUR BONUS: Audit Log
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'LOGIN',
                'ip_address' => $request->ip(),
                'details' => 'User berhasil login'
            ]);

            return redirect()->intended('/dashboard');
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // Validasi input kuat & Server-side validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Enkripsi password menggunakan Bcrypt
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Bcrypt
            'role' => 'user',
        ]);

        Auth::login($user);

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'REGISTER',
            'ip_address' => $request->ip(),
            'details' => 'User baru mendaftar'
        ]);

        return redirect('/dashboard');
    }

    public function logout(Request $request) {
        if (Auth::check()) {
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'LOGOUT',
                'ip_address' => $request->ip(),
                'details' => 'User logout'
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Proteksi CSRF Token Invalidation

        return redirect('/login');
    }
}