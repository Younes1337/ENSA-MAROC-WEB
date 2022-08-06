<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cycle;
use Faker\Factory;

class CyclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cycle::create([
            'title_cycle' => "Preparatory cycle 1",
            'speciality_id' => 1
        ]);
        Cycle::create([
            'title_cycle' => "Preparatory cycle 2",
            'speciality_id' => 1
        ]);
        Cycle::create([
            'title_cycle' => "Engineering cycle 1",
            'speciality_id' => 2
        ]);
        Cycle::create([
            'title_cycle' => "Engineering cycle 2",
            'speciality_id' => 2
        ]);
        Cycle::create([
            'title_cycle' => "Engineering cycle 3",
            'speciality_id' => 2
        ]);
    }
}
