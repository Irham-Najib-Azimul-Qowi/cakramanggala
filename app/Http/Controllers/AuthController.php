<?php

// File: app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $remember = $request->boolean('remember');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Cek batasan role (Hanya admin yang boleh masuk dashboard)
            if ($user->role !== 'admin') {
                Auth::logout();
                Log::warning('Non-admin tried to login to dashboard', ['email' => $user->email]);
                throw ValidationException::withMessages([
                    'email' => 'Akses ditolak. Hanya Admin yang dapat mengakses dashboard.',
                ]);
            }

            // Batasi maksimal 5 sesi aktif (menggunakan database session driver)
            $sessions = \DB::table('sessions')
                ->where('user_id', $user->id)
                ->orderBy('last_activity', 'desc')
                ->get();

            if ($sessions->count() >= 5) {
                // Hapus sesi tertua jika sudah mencapai batas 5
                \DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->orderBy('last_activity', 'asc')
                    ->limit($sessions->count() - 4) // Sisakan 4 untuk yang baru masuk jadi ke-5
                    ->delete();
            }

            $request->session()->regenerate();

            // Log successful login
            Log::info('Admin logged in successfully', [
                'user_id' => $user->id,
                'ip' => $request->ip(),
            ]);

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Selamat datang Admin!');
        }

        // Log failed login attempt
        Log::warning('Failed login attempt', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now(),
        ]);

        // If login fails, return back with error
        throw ValidationException::withMessages([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        // Log logout
        if (Auth::check()) {
            Log::info('User logged out', [
                'email' => Auth::user()->email,
                'ip' => $request->ip(),
                'timestamp' => now(),
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda telah berhasil keluar.');
    }
}
