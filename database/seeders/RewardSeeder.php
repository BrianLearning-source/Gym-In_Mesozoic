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
            'image' => 'rewards/handuk.jpg',
            'points_required' => 500,
            'stock' => 10,
        ],
        [   'name' => 'Tumbler Gym',
            'image' => 'rewards/tumbler.png',
            'points_required' => 600,
            'stock' => 10,
        ],    
        [
            'name' => 'Tas Gym',
            'image' => 'rewards/tasGym.jpg',
            'points_required' => 1000,
            'stock' => 5,
        ],
        [
            'name' => 'ShakerBottle',
            'image' => 'rewards/shaker.jpg',
            'points_required' => 700,
            'stock' => 15,
        ]
       ];

       DB::table('m_rewards')->truncate();

       DB::table('m_rewards')->insert($data);

    }
}
