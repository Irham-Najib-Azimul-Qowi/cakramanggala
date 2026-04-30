<?php
// File: app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // Validate the login request
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'g-recaptcha-response' => ['required'], // reCAPTCHA sudah divalidasi di middleware
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'g-recaptcha-response.required' => 'Mohon selesaikan verifikasi reCAPTCHA.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'g-recaptcha-response'));
        }

        // Get credentials
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Log successful login
            Log::info('User logged in successfully', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now(),
            ]);

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Selamat datang kembali!');
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