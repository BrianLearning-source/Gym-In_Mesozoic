<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Ini seeder cuma buat testing doang. Nanti kalau udah ada data asli, bisa dihapus.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'Grand Regentt Brian',
                'gender' => 'male',
                'email' => 'brianseraf@gmail.com',
                'password' => Hash::make('1234'),
                'phone_number' => '+62 812-3456-7890',
                'join_date' => '2020-01-15',
                'points' => 67000,
                'streak' => 67,
                'highest_streak' => 67,
                'created_at' => now(),
            ],
        ];

        DB::table('m_anggota')->insert($data);
    }
}
