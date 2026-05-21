<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // --- m_level ---
        DB::table('m_level')->insertOrIgnore([
            ['level_id' => 1, 'level_kode' => 'MBR', 'level_nama' => 'Member'],
            ['level_id' => 2, 'level_kode' => 'ADM', 'level_nama' => 'Admin'],
        ]);

        // --- m_anggota ---
        $anggotaId = DB::table('m_anggota')->insertGetId([
            'name' => 'User Uji Coba',
            'gender' => 'Laki-laki',
            'email' => 'testuser@example.com',
            'password' => Hash::make('1234'),
            'phone_number' => '+62 812-9876-5432',
            'join_date' => '2026-01-01',
            'points' => 15000,
            'streak' => 7,
            'highest_streak' => 14,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // --- m_perkembangan (full current week) ---
        $today = now();
        $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);

        $durations = [
            ['start' => '07:00:00', 'end' => '08:30:00', 'weight' => 82, 'cal' => 320, 'diary' => 'Latihan pagi kardio 30 menit + angkat beban upper body.'],
            ['start' => '06:30:00', 'end' => '08:00:00', 'weight' => 81, 'cal' => 350, 'diary' => 'Fokus leg day: squat, lunges, calf raises.'],
            ['start' => '07:15:00', 'end' => '08:45:00', 'weight' => 81, 'cal' => 310, 'diary' => 'Push day: bench press, shoulder press, triceps.'],
           
        ];

        foreach ($durations as $i => $d) {
            $date = $startOfWeek->copy()->addDays($i);

            DB::table('m_perkembangan')->insert([
                'anggota_id' => $anggotaId,
                'date' => $date->format('Y-m-d'),
                'start_time' => $d['start'],
                'end_time' => $d['end'],
                'weight' => $d['weight'],
                'height' => 175,
                'calory_burned' => $d['cal'],
                'diary' => $d['diary'],
                'created_at' => $date->copy()->setTime(8, 0, 0),
                'updated_at' => $date->copy()->setTime(8, 0, 0),
            ]);
        }

        // --- m_rewards ---
        DB::table('m_rewards')->insertOrIgnore([
            ['name' => 'Handuk Gym', 'image' => 'rewards/handuk.jpg', 'points_required' => 500, 'stock' => 10],
            ['name' => 'Tumbler Gym', 'image' => 'rewards/tumbler.png', 'points_required' => 600, 'stock' => 10],
            ['name' => 'Gym Bag', 'image' => 'rewards/gymbag.jpg', 'points_required' => 1200, 'stock' => 5],
            ['name' => 'Shaker Bottle', 'image' => 'rewards/shaker.png', 'points_required' => 300, 'stock' => 15],
        ]);

        // --- users (admin login) ---
        DB::table('users')->insertOrIgnore([
            'name' => 'Admin Testing',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->command->info("Test data created! Anggota ID: {$anggotaId}, Email: testuser@example.com, Password: 1234");
    }
}
