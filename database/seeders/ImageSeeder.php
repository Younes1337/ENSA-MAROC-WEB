<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paths = [
            "/storage/uploads/images/image-safi1.jpg", "/storage/uploads/images/image-safi2.jpg",
            "/storage/uploads/images/image-safi5.jpg", "/storage/uploads/images/image-safi3.jpg",
            "/storage/uploads/images/image-safi6.jpg", "/storage/uploads/images/image-safi4.jpg",
            "/storage/uploads/images/image-safi7.jpg"
        ];

        foreach ($paths as $path) {
            Image::create([
                'path' => $path,
                'size' => 5012,
                'type' => "image/jpg",
                'e_n_s_a_id' => 1
            ]);
        }
    }
}
