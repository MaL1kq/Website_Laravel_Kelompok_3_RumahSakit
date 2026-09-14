<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Super Admin
        User::create([
            'name' => 'Administrator RSGM',
            'email' => 'admin@grahamedika.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
            'phone' => '02155557777',
        ]);

        // 2. Seed Default Patient
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('budi123'),
            'role' => 'patient',
            'status' => 'active',
            'nik' => '3172010203040005',
            'dob' => '1990-05-15',
            'phone' => '081234567890',
        ]);

        // 3. Seed 8 Default Doctors
        $doctors = [
            [
                'name' => 'dr. Adrian Sp.A',
                'email' => 'adrian@grahamedika.com',
                'spec' => 'anak',
                'spec_label' => 'Spesialis Anak (Pediatri)',
                'avatar_icon' => 'fa-baby-carriage',
                'fee' => 150000,
                'rating' => 4.9,
                'brief_days' => 'Senin, Rabu, Jumat',
                'schedule' => [
                    ['day' => 'Senin', 'hours' => '08:00 - 12:00'],
                    ['day' => 'Rabu', 'hours' => '08:00 - 12:00'],
                    ['day' => 'Jumat', 'hours' => '08:00 - 12:00']
                ],
            ],
            [
                'name' => 'dr. Rian Sp.A',
                'email' => 'rian@grahamedika.com',
                'spec' => 'anak',
                'spec_label' => 'Spesialis Anak (Pediatri)',
                'avatar_icon' => 'fa-child',
                'fee' => 140000,
                'rating' => 4.8,
                'brief_days' => 'Selasa, Kamis, Sabtu',
                'schedule' => [
                    ['day' => 'Selasa', 'hours' => '13:00 - 16:00'],
                    ['day' => 'Kamis', 'hours' => '13:00 - 16:00'],
                    ['day' => 'Sabtu', 'hours' => '09:00 - 12:00']
                ],
            ],
            [
                'name' => 'dr. Sarah Sp.OG',
                'email' => 'sarah@grahamedika.com',
                'spec' => 'kandungan',
                'spec_label' => 'Spesialis Kandungan & Kebidanan',
                'avatar_icon' => 'fa-person-pregnant',
                'fee' => 180000,
                'rating' => 4.9,
                'brief_days' => 'Senin, Selasa, Kamis',
                'schedule' => [
                    ['day' => 'Senin', 'hours' => '14:00 - 18:00'],
                    ['day' => 'Selasa', 'hours' => '14:00 - 18:00'],
                    ['day' => 'Kamis', 'hours' => '14:00 - 18:00']
                ],
            ],
            [
                'name' => 'dr. Kartika Sp.OG',
                'email' => 'kartika@grahamedika.com',
                'spec' => 'kandungan',
                'spec_label' => 'Spesialis Kandungan & Kebidanan',
                'avatar_icon' => 'fa-female',
                'fee' => 175000,
                'rating' => 4.9,
                'brief_days' => 'Rabu, Jumat, Sabtu',
                'schedule' => [
                    ['day' => 'Rabu', 'hours' => '09:00 - 13:00'],
                    ['day' => 'Jumat', 'hours' => '09:00 - 13:00'],
                    ['day' => 'Sabtu', 'hours' => '13:00 - 16:00']
                ],
            ],
            [
                'name' => 'dr. Budi Sp.PD',
                'email' => 'budi.spec@grahamedika.com',
                'spec' => 'dalam',
                'spec_label' => 'Spesialis Penyakit Dalam',
                'avatar_icon' => 'fa-stethoscope',
                'fee' => 160000,
                'rating' => 4.8,
                'brief_days' => 'Senin s/d Jumat',
                'schedule' => [
                    ['day' => 'Senin', 'hours' => '09:00 - 13:00'],
                    ['day' => 'Selasa', 'hours' => '09:00 - 13:00'],
                    ['day' => 'Rabu', 'hours' => '13:00 - 17:00'],
                    ['day' => 'Jumat', 'hours' => '13:00 - 17:00']
                ],
            ],
            [
                'name' => 'dr. Haryono Sp.JP',
                'email' => 'haryono@grahamedika.com',
                'spec' => 'jantung',
                'spec_label' => 'Spesialis Jantung & Pembuluh Darah',
                'avatar_icon' => 'fa-heart-pulse',
                'fee' => 250000,
                'rating' => 4.9,
                'brief_days' => 'Selasa & Kamis',
                'schedule' => [
                    ['day' => 'Selasa', 'hours' => '08:00 - 11:00'],
                    ['day' => 'Kamis', 'hours' => '08:00 - 11:00']
                ],
            ],
            [
                'name' => 'dr. Wijaya Sp.B',
                'email' => 'wijaya@grahamedika.com',
                'spec' => 'bedah',
                'spec_label' => 'Spesialis Bedah Umum',
                'avatar_icon' => 'fa-scalpel',
                'fee' => 220000,
                'rating' => 4.8,
                'brief_days' => 'Senin, Rabu, Kamis',
                'schedule' => [
                    ['day' => 'Senin', 'hours' => '13:00 - 16:00'],
                    ['day' => 'Rabu', 'hours' => '13:00 - 16:00'],
                    ['day' => 'Kamis', 'hours' => '09:00 - 12:00']
                ],
            ],
            [
                'name' => 'drg. Shinta',
                'email' => 'shinta@grahamedika.com',
                'spec' => 'gigi',
                'spec_label' => 'Dokter Gigi & Mulut',
                'avatar_icon' => 'fa-tooth',
                'fee' => 130000,
                'rating' => 4.9,
                'brief_days' => 'Senin s/d Jumat',
                'schedule' => [
                    ['day' => 'Senin', 'hours' => '09:00 - 12:00'],
                    ['day' => 'Selasa', 'hours' => '14:00 - 17:00'],
                    ['day' => 'Rabu', 'hours' => '09:00 - 12:00'],
                    ['day' => 'Kamis', 'hours' => '14:00 - 17:00'],
                    ['day' => 'Jumat', 'hours' => '09:00 - 12:00']
                ],
            ],
        ];

        foreach ($doctors as $doc) {
            User::create([
                'name' => $doc['name'],
                'email' => $doc['email'],
                'password' => Hash::make('dokter123'),
                'role' => 'doctor',
                'status' => 'active',
                'spec' => $doc['spec'],
                'spec_label' => $doc['spec_label'],
                'avatar_icon' => $doc['avatar_icon'],
                'fee' => $doc['fee'],
                'rating' => $doc['rating'],
                'brief_days' => $doc['brief_days'],
                'schedule' => $doc['schedule'], // Will be cast/serialized to JSON in User model
            ]);
        }
    }
}
