<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class PreventDoubleSubmission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('POST')) {
            $currentRequestToken = $request->input('_token');
            $lastSubmitTime = Session::get('last_submit_time_' . $currentRequestToken);
            $now = microtime(true);

            // Prevent resubmission within 2 seconds for the same CSRF token
            if ($lastSubmitTime && ($now - $lastSubmitTime) < 2.0) {
                return back()->with('error', 'Permintaan sedang diproses. Mohon tunggu sebentar.');
            }

            Session::put('last_submit_time_' . $currentRequestToken, $now);
        }

        return $next($request);
    }
}
