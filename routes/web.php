<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\DoctorRegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes (Informational & Patient Enforced Pages)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/layanan', [PublicController::class, 'layanan'])->name('layanan');
Route::get('/dokter', [PublicController::class, 'dokter'])->name('dokter');
Route::get('/reservasi', [PublicController::class, 'reservasi'])->name('reservasi');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');

/*
|--------------------------------------------------------------------------
| Doctor Self-Registration Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/doctor/register', [DoctorRegisterController::class, 'create'])->name('doctor.register');
    Route::post('/doctor/register', [DoctorRegisterController::class, 'store'])->name('doctor.register.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated Redirect Guard Route
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'doctor') {
        return redirect()->route('doctor.dashboard');
    } else {
        return redirect()->route('patient.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Patient Role Dashboard & Bookings Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [BookingController::class, 'dashboard'])->name('patient.dashboard');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{id}/reschedule', [BookingController::class, 'reschedule'])->name('bookings.reschedule');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

/*
|--------------------------------------------------------------------------
| Doctor Role Dashboard & Queues Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::post('/doctor/bookings/{id}/complete', [DoctorController::class, 'complete'])->name('doctor.bookings.complete');
    Route::post('/doctor/bookings/{id}/cancel', [DoctorController::class, 'cancel'])->name('doctor.bookings.cancel');
});

/*
|--------------------------------------------------------------------------
| Super Admin Role Dashboard & Management Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Booking Queue Operations
    Route::post('/admin/bookings/{id}/approve', [AdminController::class, 'approveBooking'])->name('admin.bookings.approve');
    Route::post('/admin/bookings/{id}/cancel', [AdminController::class, 'cancelBooking'])->name('admin.bookings.cancel');
    Route::post('/admin/bookings/{id}/complete', [AdminController::class, 'completeBooking'])->name('admin.bookings.complete');
    
    // Doctor Management Operations
    Route::post('/admin/doctors/{id}/verify', [AdminController::class, 'verifyDoctor'])->name('admin.doctors.verify');
    Route::post('/admin/doctors', [AdminController::class, 'addDoctor'])->name('admin.doctors.store');
    Route::delete('/admin/doctors/{id}', [AdminController::class, 'deleteDoctor'])->name('admin.doctors.destroy');
});

require __DIR__.'/auth.php';
