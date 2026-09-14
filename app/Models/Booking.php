<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'booking_code',
    'queue_num',
    'patient_id',
    'doctor_id',
    'polyclinic',
    'polyclinic_label',
    'date',
    'time',
    'payment_type',
    'bpjs_number',
    'doc_fee',
    'admin_fee',
    'total_fee',
    'payment_status',
    'status'
])]
class Booking extends Model
{
    /**
     * Get the patient who made the booking.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the doctor assigned to the booking.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'doc_fee' => 'integer',
            'admin_fee' => 'integer',
            'total_fee' => 'integer',
        ];
    }
}
