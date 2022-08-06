<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OpportunitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++) {
            Opportunity::create([
                'title' => $faker->text($maxNbChars = 90),
                'description' => $faker->text($maxNbChars = 225),
                'city' => $faker->text($maxNbChars = 20),
                'country' => $faker->text($maxNbChars = 20),
                'typeO' => "job",
                'type' => 'Full-time'
            ]);
            Opportunity::create([
                'title' => $faker->text($maxNbChars = 90),
                'description' => $faker->text($maxNbChars = 225),
                'city' => $faker->text($maxNbChars = 20),
                'country' => $faker->text($maxNbChars = 20),
                'typeO' => "internship",
                'type' => 'Part-time'
            ]);
        }
    }
}
