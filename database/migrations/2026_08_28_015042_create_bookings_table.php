<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->string('queue_num');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->string('polyclinic');
            $table->string('polyclinic_label');
            $table->date('date');
            $table->string('time');
            $table->string('payment_type'); // 'BPJS' or 'Mandiri'
            $table->string('bpjs_number')->nullable();
            $table->integer('doc_fee')->default(0);
            $table->integer('admin_fee')->default(0);
            $table->integer('total_fee')->default(0);
            $table->string('payment_status'); // 'Paid', 'Pending Payment', 'Covered by BPJS'
            $table->enum('status', ['Pending', 'Approved', 'Canceled', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
