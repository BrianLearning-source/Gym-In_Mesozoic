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

        $data = [ //data dummy anggota
            [
                'name' => 'Grand Regentt Brian',
                'title' => 'Athlete',
                'gender' => 'Laki-laki',
                'email' => 'brianseraf@gmail.com',
                'password' => Hash::make('1234'),
                'phone_number' => '+62 812-3456-7890',
                'avatar' => null,
                'join_date' => '2020-01-15',
                'points' => 1000,
                'streak' => 7,
                'highest_streak' => 27,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $item) { //insert data dummy anggota to database (can be updated)
            DB::table('m_anggota')->updateOrInsert(
                ['email' => $item['email']],
                $item
            );
        }

        $anggotaId = DB::table('m_anggota')->where('email', $data[0]['email'])->value('id');


        $today = now();
        $startOfWeek = $today->copy()->startOfWeek(\Carbon\Carbon::MONDAY);

        $durations = [
            ['start' => '07:00:00', 'end' => '08:30:00', 'weight' => 82, 'cal' => 320, 'diary' => 'Latihan pagi kardio 30 menit + angkat beban upper body.'],
            ['start' => '06:30:00', 'end' => '08:00:00', 'weight' => 81, 'cal' => 350, 'diary' => 'Fokus leg day: squat, lunges, calf raises.'],
            ['start' => '07:15:00', 'end' => '08:45:00', 'weight' => 81, 'cal' => 310, 'diary' => 'Push day: bench press, shoulder press, triceps.'],
            ['start' => '06:45:00', 'end' => '08:15:00', 'weight' => 80, 'cal' => 340, 'diary' => 'Pull day: pull-ups, rows, biceps curls.'],
            ['start' => '08:49:00', 'end' => '09:49:00', 'weight' => 75, 'cal' => 400, 'diary' => 'treadmill 1 jam'],

        ];

        foreach ($durations as $i => $d) {
            $date = $startOfWeek->copy()->addDays($i);

            DB::table('m_perkembangan')->updateOrInsert(
                [
                    'anggota_id' =>$anggotaId,
                    'date' => $date->format('Y-m-d')],
                [
                    'start_time' => $d['start'],
                    'end_time' => $d['end'],
                    'weight' => $d['weight'],
                    'height' => 175,
                    'calory_burned' => $d['cal'],
                    'diary' => $d['diary'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

    }
}
