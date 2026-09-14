<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display the Doctor Dashboard with queue list.
     */
    public function dashboard()
    {
        $doctor = Auth::user();

        // Get bookings scheduled for this doctor, sorted by date (newest first for record view, or current day first)
        $bookings = Booking::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();

        return view('doctor.dashboard', compact('bookings'));
    }

    /**
     * Mark a patient queue as Completed.
     */
    public function complete($id)
    {
        $booking = Booking::where('id', $id)
            ->where('doctor_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'Approved' && $booking->status !== 'Pending') {
            return back()->with('error', 'Status antrean tidak valid untuk diselesaikan.');
        }

        $booking->update([
            'status' => 'Completed'
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Antrean pasien berhasil ditandai selesai.');
    }

    /**
     * Doctor cancel patient queue.
     */
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('doctor_id', Auth::id())
            ->firstOrFail();

        if ($booking->status === 'Completed') {
            return back()->with('error', 'Antrean yang sudah selesai tidak dapat dibatalkan.');
        }

        $booking->update([
            'status' => 'Canceled'
        ]);

        return redirect()->route('doctor.dashboard')->with('success', 'Antrean pasien berhasil dibatalkan oleh dokter.');
    }
}
