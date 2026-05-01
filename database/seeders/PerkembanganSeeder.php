<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerkembanganSeeder extends Seeder
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
                'anggota_id' => 1,
                'date' => '2025-03-10',
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
                'weight' => 85,
                'height' => 180,
                'calory_burned' => 250,
                'diary' => 'Latihan kardio dan angkat beban ringan. Tadi juga ketemu sama orang aneh.',
                'created_at' => now(),
            ],
        ];

        DB::table('m_perkembangan')->insert($data);
    }
}
