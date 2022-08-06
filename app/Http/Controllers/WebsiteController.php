<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\phones_websites;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Website::with("phones")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'long_description' => "required|string",
            'short_description' => "required|string",
            'logo' => "image|max:4096",
            'email' => "required|email|string|max:255",
            'language' => "required|string|max:255",
            'facebook_link' => "required|string|max:255",
            'instagram_link' => "required|string|max:255",
            'linkedin_link'=> "required|string|max:255",
            'youtube_link' => "required|string|max:255",
        ]);

        $logo_path = "/images/logos/default.png";
        if ($request->hasFile('logo')) {
            $name = "ensa_logo" . date_format(date_create(), "YmdHis");
            $logo_path = $request->file('logo')->storeAs('uploads/logo', $name, 'public');
        }

        $request->merge([
            "logo" => $logo_path,
        ]);

        $id_website = Website::create($request->all())->id;

        $phones = $request->phones;

        foreach ($phones as $phone) {
            $start_indexes = ["6", "7", "8"];
            $start_with_mobile = false;
            foreach ($start_indexes as $index) {
                $start_with_mobile =  $start_with_mobile || (str_starts_with($phone, "+2120" . $index) || str_starts_with($phone, "0" . $index));
            }
            $type = $start_with_mobile  ? "mobile" : "fix";

            $id_phone = Phone::create([
                'phone_number' => $phone,
                'type' => $type
            ])->id;
            phones_websites::create([
                'phone_id' => $id_phone,
                'website_id' => $id_website
            ]);
        }

        return ["message" => "website created"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'long_description' => "required|string",
            'short_description' => "required|string",
            'email' => "required|email|string|max:255",
            'language' => "required|string|max:255",
            'facebook_link' => "required|string|max:255",
            'instagram_link' => "required|string|max:255",
            'linkedin_link'=> "required|string|max:255",
            'youtube_link' => "required|string|max:255"
        ]);

        $website = Website::find($id);

        $mobiles = $request->phones_list;
        $fix = $request->fix;

        foreach ($mobiles as $phone) {
            $phonesInDatabase = (array)Phone::pluck("phone_number");
            if (in_array($phone, $phonesInDatabase)) continue;

            $id_phone = Phone::create([
                'phone_number' => $phone,
                'type' => "mobile"
            ])->id;
            phones_websites::create([
                'phone_id' => $id_phone,
                'website_id' => $id
            ]);
        }

        if ($fix) {
            foreach ($fix as $phone) {
                $phonesInDatabase = (array)Phone::pluck("phone_number");
                if (in_array($phone, $phonesInDatabase)) continue;

                $id_phone = Phone::create([
                    'phone_number' => $phone,
                    'type' => "fix"
                ])->id;
                phones_websites::create([
                    'phone_id' => $id_phone,
                    'website_id' => $id
                ]);
            }
        }

        return $website->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
