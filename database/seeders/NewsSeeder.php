<?php

namespace Database\Seeders;

use App\Models\News;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Facades\Storage;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $listImages = array_filter(Storage::disk('public')->files('/uploads/news'), function ($item) {
            return strpos($item, '.jpg') || strpos($item, '.png');
        });

        foreach ($listImages as $image) {
            News::create([
                "title" => $faker->text($maxNbChars = 40),
                "description" => $faker->text(),
                'short_description' => $faker->text($maxNbChars = 100),
                "image" => "/storage/$image",
                "e_n_s_a_id" => 1,
            ]);
        }
    }
}
