<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data = [
        [   'name' => 'Handuk Gym',
            'image' => 'rewards/01KQY2X7Y57DZ2W2DRC01GEXA5.jpg',
            'points_required' => 500,
            'stock' => 10,
        ],
        [   'name' => 'Tumbler Gym',
            'image' => 'rewards/tumbler.png',
            'points_required' => 600,
            'stock' => 10,
        ],    
       ];

       DB::table('m_rewards')->truncate();

       DB::table('m_rewards')->insert($data);

    }
}
