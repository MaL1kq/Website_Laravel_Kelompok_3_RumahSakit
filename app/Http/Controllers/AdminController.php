<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the Admin Dashboard with stats, bookings, active & pending doctors.
     */
    public function dashboard()
    {
        // 1. Calculate Statistics
        // Total Omset: Accumulate total_fee from paid bookings that are Approved or Completed
        $totalOmset = Booking::where('payment_status', 'Paid')
            ->whereIn('status', ['Approved', 'Completed'])
            ->sum('total_fee');

        $activeDoctorsCount = User::where('role', 'doctor')->where('status', 'active')->count();
        $pendingDoctorsCount = User::where('role', 'doctor')->where('status', 'pending')->count();
        $totalBookingsCount = Booking::count();

        // 2. Fetch Lists
        $bookings = Booking::with(['patient', 'doctor'])
            ->orderBy('created_at', 'desc')
            ->get();

        $activeDoctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        $pendingDoctors = User::where('role', 'doctor')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'totalOmset', 'activeDoctorsCount', 'pendingDoctorsCount', 'totalBookingsCount',
            'bookings', 'activeDoctors', 'pendingDoctors'
        ));
    }

    /**
     * Approve a patient's booking queue.
     */
    public function approveBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'Approved']);

        return redirect()->route('admin.dashboard')->with('success', 'Antrean pasien berhasil disetujui.');
    }

    /**
     * Cancel a patient's booking queue.
     */
    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'Canceled']);

        return redirect()->route('admin.dashboard')->with('success', 'Antrean pasien berhasil dibatalkan.');
    }

    /**
     * Mark a patient's booking queue as Completed.
     */
    public function completeBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'Completed']);

        return redirect()->route('admin.dashboard')->with('success', 'Antrean pasien ditandai selesai.');
    }

    /**
     * Verify and activate a pending self-registered doctor.
     */
    public function verifyDoctor($id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->firstOrFail();
        $doctor->update(['status' => 'active']);

        return redirect()->route('admin.dashboard')->with('success', "Akun dr. {$doctor->name} berhasil diverifikasi dan diaktifkan.");
    }

    /**
     * Register a new doctor directly from the admin panel.
     */
    public function addDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'spec' => 'required|string',
            'fee' => 'required|integer|min:0',
            'working_days' => 'required|array|min:1',
            'working_hours_start' => 'required|string',
            'working_hours_end' => 'required|string',
        ]);

        // Polyclinic translation mappings
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

        // Format schedule structure
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
            'status' => 'active', // Direct creation by admin is auto-active
            'spec' => $request->spec,
            'spec_label' => $specLabels[$request->spec] ?? 'Spesialis Medis',
            'avatar_icon' => $avatarIcons[$request->spec] ?? 'fa-user-doctor',
            'fee' => $request->fee,
            'rating' => 4.8, // Default rating for new doctor
            'schedule' => $schedule,
            'brief_days' => $briefDays,
        ]);

        return redirect()->route('admin.dashboard')->with('success', "Dokter baru {$request->name} berhasil ditambahkan.");
    }

    /**
     * Delete/remove a doctor user from database.
     */
    public function deleteDoctor($id)
    {
        $doctor = User::where('id', $id)->where('role', 'doctor')->firstOrFail();
        $doctor->delete();

        return redirect()->route('admin.dashboard')->with('success', "Akun dokter {$doctor->name} berhasil dihapus dari database.");
    }
}
