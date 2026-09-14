<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    /**
     * Display the home page with dynamic active doctors.
     */
    public function index()
    {
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->orderBy('rating', 'desc')
            ->take(4) // Show top 4 featured doctors on homepage
            ->get();

        return view('public.index', compact('doctors'));
    }

    /**
     * Display the About page.
     */
    public function tentang()
    {
        return view('public.tentang');
    }

    /**
     * Display the Services page.
     */
    public function layanan()
    {
        return view('public.layanan');
    }

    /**
     * Display the Doctor Directory page with search & filter.
     */
    public function dokter(Request $request)
    {
        $query = User::where('role', 'doctor')->where('status', 'active');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('spec_label', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('poli') && !empty($request->poli) && $request->poli !== 'all') {
            $query->where('spec', $request->poli);
        }

        $doctors = $query->orderBy('name', 'asc')->get();

        return view('public.dokter', compact('doctors'));
    }

    /**
     * Display the Online Reservation Page.
     */
    public function reservasi()
    {
        // Enforce login for patients
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Silakan masuk terlebih dahulu untuk melakukan reservasi online.');
        }

        if (Auth::user()->role !== 'patient') {
            return redirect()->route('home')->with('error', 'Hanya akun Pasien yang dapat melakukan reservasi online.');
        }

        // Get all active doctors with their schedules for dropdown selection
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->get();

        return view('public.reservasi', compact('doctors'));
    }

    /**
     * Display the Contact page.
     */
    public function kontak()
    {
        return view('public.kontak');
    }
}
