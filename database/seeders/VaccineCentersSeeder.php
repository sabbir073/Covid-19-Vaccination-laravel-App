<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineCentersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vaccine_centers')->insert([
            ['name' => 'Center A', 'daily_limit' => 100],
            ['name' => 'Center B', 'daily_limit' => 150],
            ['name' => 'Center C', 'daily_limit' => 80],
            ['name' => 'Center D', 'daily_limit' => 120],
            ['name' => 'Center E', 'daily_limit' => 200],
            ['name' => 'Center F', 'daily_limit' => 75],
            ['name' => 'Center G', 'daily_limit' => 90],
            ['name' => 'Center H', 'daily_limit' => 60],
            ['name' => 'Center I', 'daily_limit' => 110],
            ['name' => 'Center J', 'daily_limit' => 95],
        ]);
    }
}
