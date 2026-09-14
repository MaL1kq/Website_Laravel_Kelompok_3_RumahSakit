<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check role match
        if ($user->role !== $role) {
            // Redirect to their respective dashboards or home
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard');
            } else {
                return redirect()->route('patient.dashboard');
            }
        }

        // Additional status check for doctors
        if ($role === 'doctor' && $user->status !== 'active') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun dokter Anda sedang menanti verifikasi dari Administrator.');
        }

        return $next($request);
    }
}
