<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DoctorRegisterController extends Controller
{
    /**
     * Show the doctor registration view.
     */
    public function create()
    {
        return view('auth.doctor-register');
    }

    /**
     * Handle doctor registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:6'],
            'spec' => ['required', 'string'],
            'fee' => ['required', 'integer', 'min:0'],
            'phone' => ['required', 'string'],
            'working_days' => ['required', 'array', 'min:1'],
            'working_hours_start' => ['required', 'string'],
            'working_hours_end' => ['required', 'string'],
        ]);

        $specLabels = [
            'anak' => 'Spesialis Anak (Pediatri)',
            'kandungan' => 'Spesialis Kandungan & Kebidanan',
            'dalam' => 'Spesialis Penyakit Dalam',
            'jantung' => 'Spesialis Jantung & Pembuluh Darah',
            'bedah' => 'Spesialis Bedah Umum',
            'gigi' => 'Dokter Gigi & Mulut',
        ];
        
        $avatarIcons = [
            'anak' => 'fa-child',
            'kandungan' => 'fa-person-pregnant',
            'dalam' => 'fa-stethoscope',
            'jantung' => 'fa-heart-pulse',
            'bedah' => 'fa-scalpel',
            'gigi' => 'fa-tooth',
        ];

        // Format working hours and schedule
        $schedule = [];
        $days = [];
        $hoursStr = "{$request->working_hours_start} - {$request->working_hours_end}";
        foreach ($request->working_days as $day) {
            $schedule[] = [
                'day' => $day,
                'hours' => $hoursStr
            ];
            $days[] = $day;
        }

        $briefDays = implode(', ', $days);
        if (count($days) === 5 && !in_array('Sabtu', $days) && !in_array('Minggu', $days)) {
            $briefDays = 'Senin s/d Jumat';
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
            'status' => 'pending', // Doctor self-registration defaults to 'pending' verification
            'phone' => $request->phone,
            'spec' => $request->spec,
            'spec_label' => $specLabels[$request->spec] ?? 'Spesialis Medis',
            'avatar_icon' => $avatarIcons[$request->spec] ?? 'fa-user-doctor',
            'fee' => $request->fee,
            'rating' => 4.8, // Default initial rating
            'schedule' => $schedule,
            'brief_days' => $briefDays,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi Dokter Berhasil! Akun Anda saat ini sedang menanti verifikasi dan persetujuan dari Administrator sebelum dapat masuk.');
    }
}
