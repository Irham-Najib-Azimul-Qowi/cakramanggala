<?php
// File: app/Http/Middleware/RecaptchaMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RecaptchaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip reCAPTCHA validation in testing environment
        if (app()->environment('testing')) {
            return $next($request);
        }

        // Skip if reCAPTCHA is disabled (useful for development)
        if (!config('services.recaptcha.site_key') || !config('services.recaptcha.secret_key')) {
            Log::warning('reCAPTCHA keys not configured, skipping validation');
            return $next($request);
        }

        // Get reCAPTCHA response from request
        $recaptchaResponse = $request->input('g-recaptcha-response');
        
        // Check if reCAPTCHA response exists
        if (!$recaptchaResponse) {
            return back()->withErrors([
                'g-recaptcha-response' => 'Mohon selesaikan verifikasi reCAPTCHA.'
            ])->withInput($request->except('password', 'g-recaptcha-response'));
        }

        try {
            // Verify reCAPTCHA with Google
            $response = Http::timeout(30)->asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();

            // Check if verification was successful
            if (!$result || !isset($result['success']) || !$result['success']) {
                $errorMessages = [];
                
                if (isset($result['error-codes'])) {
                    foreach ($result['error-codes'] as $errorCode) {
                        switch ($errorCode) {
                            case 'missing-input-secret':
                                $errorMessages[] = 'Konfigurasi reCAPTCHA tidak valid.';
                                Log::error('reCAPTCHA missing-input-secret error');
                                break;
                            case 'invalid-input-secret':
                                $errorMessages[] = 'Secret key reCAPTCHA tidak valid.';
                                Log::error('reCAPTCHA invalid-input-secret error');
                                break;
                            case 'missing-input-response':
                                $errorMessages[] = 'Mohon selesaikan verifikasi reCAPTCHA.';
                                break;
                            case 'invalid-input-response':
                                $errorMessages[] = 'Verifikasi reCAPTCHA tidak valid. Silakan coba lagi.';
                                break;
                            case 'bad-request':
                                $errorMessages[] = 'Permintaan reCAPTCHA tidak valid.';
                                Log::error('reCAPTCHA bad-request error');
                                break;
                            case 'timeout-or-duplicate':
                                $errorMessages[] = 'reCAPTCHA telah kedaluwarsa. Silakan coba lagi.';
                                break;
                            default:
                                $errorMessages[] = 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.';
                                Log::warning('reCAPTCHA unknown error: ' . $errorCode);
                        }
                    }
                } else {
                    $errorMessages[] = 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.';
                    Log::warning('reCAPTCHA verification failed without error codes', ['result' => $result]);
                }

                return back()->withErrors([
                    'g-recaptcha-response' => implode(' ', $errorMessages)
                ])->withInput($request->except('password', 'g-recaptcha-response'));
            }

            // Optional: Check score for reCAPTCHA v3 (if you want to implement it later)
            if (isset($result['score']) && $result['score'] < 0.5) {
                Log::warning('reCAPTCHA score too low', ['score' => $result['score']]);
                return back()->withErrors([
                    'g-recaptcha-response' => 'Verifikasi keamanan gagal. Silakan coba lagi.'
                ])->withInput($request->except('password', 'g-recaptcha-response'));
            }

            // Log successful reCAPTCHA verification
            Log::info('reCAPTCHA verification successful', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification exception', [
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors([
                'g-recaptcha-response' => 'Terjadi kesalahan saat memverifikasi reCAPTCHA. Silakan coba lagi.'
            ])->withInput($request->except('password', 'g-recaptcha-response'));
        }

        return $next($request);
    }
}