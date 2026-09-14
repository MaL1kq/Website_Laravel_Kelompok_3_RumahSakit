<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display the Patient Dashboard with booking history.
     */
    public function dashboard()
    {
        $patient = Auth::user();
        
        $bookings = Booking::where('patient_id', $patient->id)
            ->with('doctor')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();

        return view('patient.dashboard', compact('bookings'));
    }

    /**
     * Process and store a new online reservation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'polyclinic' => 'required|string',
            'polyclinic_label' => 'required|string',
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'payment_type' => 'required|in:BPJS,Mandiri',
            'bpjs_number' => 'required_if:payment_type,BPJS|nullable|string',
        ]);

        $doctor = User::findOrFail($request->doctor_id);
        $patient = Auth::user();

        // 1. Verify doctor works on selected date
        $dayNameIndo = $this->getIndoDayName($request->date);
        $isWorking = false;
        foreach ($doctor->schedule as $sched) {
            if (strcasecmp($sched['day'], $dayNameIndo) === 0) {
                $isWorking = true;
                break;
            }
        }

        if (!$isWorking) {
            return back()->withErrors(['date' => "dr. {$doctor->name} tidak memiliki jadwal praktek pada hari {$dayNameIndo}."])->withInput();
        }

        // 2. Generate Booking Code (RSGM-YYYY-RANDOM)
        $year = date('Y', strtotime($request->date));
        $rand = strtoupper(Str::random(5));
        $bookingCode = "RSGM-{$year}-{$rand}";

        // 3. Calculate Queue Number for the doctor on that day
        $existingCount = Booking::where('doctor_id', $doctor->id)
            ->where('date', $request->date)
            ->count();
        $queueNum = 'Q-' . str_pad($existingCount + 1, 2, '0', STR_PAD_LEFT);

        // 4. Set fees and payment status
        $docFee = $doctor->fee ?? 150000;
        $adminFee = 15000;
        $totalFee = $request->payment_type === 'BPJS' ? 0 : ($docFee + $adminFee);
        $paymentStatus = $request->payment_type === 'BPJS' ? 'Covered by BPJS' : 'Paid';

        // 5. Create Booking
        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'queue_num' => $queueNum,
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'polyclinic' => $request->polyclinic,
            'polyclinic_label' => $request->polyclinic_label,
            'date' => $request->date,
            'time' => $request->time,
            'payment_type' => $request->payment_type,
            'bpjs_number' => $request->bpjs_number,
            'doc_fee' => $docFee,
            'admin_fee' => $adminFee,
            'total_fee' => $totalFee,
            'payment_status' => $paymentStatus,
            'status' => 'Approved', // Auto-approved on payment success simulation
        ]);

        // Redirect to Patient Dashboard with trigger for success ticket modal
        return redirect()->route('patient.dashboard')
            ->with('success', 'Pendaftaran Berobat Anda Berhasil!')
            ->with('show_ticket_id', $booking->id);
    }

    /**
     * Reschedule an existing booking.
     */
    public function reschedule(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
        ]);

        $booking = Booking::where('id', $id)
            ->where('patient_id', Auth::id())
            ->firstOrFail();

        $doctor = User::findOrFail($booking->doctor_id);

        // Verify doctor works on selected date
        $dayNameIndo = $this->getIndoDayName($request->date);
        $isWorking = false;
        foreach ($doctor->schedule as $sched) {
            if (strcasecmp($sched['day'], $dayNameIndo) === 0) {
                $isWorking = true;
                break;
            }
        }

        if (!$isWorking) {
            return back()->with('error', "dr. {$doctor->name} tidak memiliki jadwal praktek pada hari {$dayNameIndo}.");
        }

        // Recalculate queue number for the new date
        $existingCount = Booking::where('doctor_id', $doctor->id)
            ->where('date', $request->date)
            ->count();
        $queueNum = 'Q-' . str_pad($existingCount + 1, 2, '0', STR_PAD_LEFT);

        $booking->update([
            'date' => $request->date,
            'time' => $request->time,
            'queue_num' => $queueNum,
            'status' => 'Pending', // Status goes back to pending for approval after rescheduling
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Jadwal kunjungan berobat berhasil direschedule.');
    }

    /**
     * Cancel an existing booking.
     */
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('patient_id', Auth::id())
            ->firstOrFail();

        if ($booking->status === 'Completed') {
            return back()->with('error', 'Antrean yang sudah selesai tidak dapat dibatalkan.');
        }

        $booking->update([
            'status' => 'Canceled'
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Antrean berobat berhasil dibatalkan.');
    }

    /**
     * Helper: Get Indonesian Day name from date string.
     */
    private function getIndoDayName($dateString)
    {
        $dayName = date('l', strtotime($dateString));
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        return $days[$dayName] ?? '';
    }
}
