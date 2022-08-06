<?php

namespace Database\Seeders;

use App\Models\Club;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ClubsSeeder extends Seeder
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
            Club::create([
                'title' => $faker->text($maxNbChars = 40),
                'image' => "/storage/uploads/clubs/default.jpg",
                'description' => $faker->text(),
                'short_description' => $faker->text($maxNbChars = 100),
                'category' => "Arts",
                'e_n_s_a_id' => 1
            ]);
        }
    }
}
