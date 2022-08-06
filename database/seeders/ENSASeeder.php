<?php

namespace Database\Seeders;

use App\Models\ENSA;
use Illuminate\Database\Seeder;

class ENSASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ENSA::create([
            "title"=> "ENSA Safi",
            "intro"=> "<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis </p>
                        <p>sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>",
            "city"=> "SAFI",
            "type"=> "école d\"ingénieur",
            "website"=> "http://www.ensas.uca.ma/",
            "address"=> "Route Sidi Bouzid BP 63, 46000 - Safi, Maroc",
            "campus"=> "girls",
            "logo" => "/storage/images/logos/ENSASafi_logo20211230221600.webp",
            "restaurants"=> "girls",
            "carte" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3371.4425866671045!2d-9.265849184829342!3d32.32682598111032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdac2176b55d2d85%3A0x8f039c8e14c1a1af!2sNational%20school%20of%20Applied%20sciences%20of%20Safi!5e0!3m2!1sen!2sma!4v1646151754246!5m2!1sen!2sma",
            "initial_education"=> "<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis </p>
                                    <p>sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>",
            "continuing_education"=> "<p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis </p>
                                    <p>sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>",
            "cooperation"=> " <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis </p>
                                <p>sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>
                                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis </p>
                                <p>sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis</p>",
            "published"=> "1"
        ]);
    }
}
