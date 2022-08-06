<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Email;
use App\Models\ENSA;
use App\Models\Image;
use App\Models\Phone;
use App\Models\phones_ensas;
use App\Models\Semester;
use App\Models\Speciality;
use Illuminate\Http\Request;

class EnsaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ENSA::with(["phones", "emails"])->get();
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
            'title' => "required|string|max:255",
            'intro' => "required|string",
            'city' => "required|string|max:255",
            'type' => "required|string|max:255",
            'website' => "required|string|max:255",
            'address' => "required|string",
            'campus' => "required|string",
            'restaurants' => "required|string",
            'carte' => "string",
            'initial_education' => "required|string",
            'continuing_education' => "required|string",
            'cooperation' => "string",
            'published' => "required|string"
        ]);

        $path = "/images";

        $logo_path = "$path/logos/default.png";
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = str_replace(' ', '', $request->title) . "_logo" . date_format(date_create(), "YmdHis"). "." . $file->extension();
            $file->storeAs("$path/logos", $name, 'public');
            $logo_path = "/storage$path/logos/" . $name;
        }

        $coverPicture_path = "$path/cover_pictures/default.png";
        if($request->hasFile('cover_picture')) {
            $file = $request->file('cover_picture');
            $name = str_replace(' ', '', $request->title) . "_cover_picture" . date_format(date_create(), "YmdHis"). "." . $file->extension();
            $file->storeAs("$path/cover_pictures", $name, 'public');
            $coverPicture_path = "/storage$path/cover_pictures/" . $name;
        }

        $published = $request->published;

        $id = ENSA::create(array_merge($request->all(), [
            "logo" => $logo_path,
            "cover_picture" => $coverPicture_path,
            "published" => $published == "true"
        ]))->id;

        foreach ($request->emails as $email) {
            Email::create([
                'email' => $email,
                'e_n_s_a_id' => $id
            ]);
        }

        foreach ($request->phones as $phone) {
            $id_phone = Phone::create([
                'phone_number' => $phone,
                'type' => "mobile"
            ])->id;
            phones_ensas::create([
                'phone_id' => $id_phone,
                'e_n_s_a_id' => $id
            ]);
        }

        foreach ($request->fixes as $phone) {
            $id_phone = Phone::create([
                'phone_number' => $phone,
                'type' => "fix"
            ])->id;
            phones_ensas::create([
                'phone_id' => $id_phone,
                'e_n_s_a_id' => $id
            ]);
        }

        foreach ($request->images as $image) {
            $name = str_replace(' ', '', $request->title) . "_image" . date_format(date_create(), "YmdHis"). "." . $image->extension();
            $image->storeAs("uploads/images", $name, 'public');
            $image_path = "/storage/uploads/images/" . $name;

            Image::create([
                'path' => $image_path,
                'size' => $image->getSize(),
                'type' => $image->getClientMimeType(),
                'e_n_s_a_id' => $id
            ]);
        }

        $id_speciality = Speciality::create([
            'title_specialty' => "Classe preparatoire",
            'e_n_s_a_id' => $id
        ])->id;

        $id_cycle = Cycle::create([
            'title_cycle' => "Preparatory cycle 1",
            'speciality_id' => $id_speciality
        ])->id;

        foreach ([1, 2] as $nbre) {
            Semester::create([
                "title_semester" => "Semester $nbre",
                "cycle_id" => $id_cycle
            ]);
        }

        $id_cycle = Cycle::create([
            'title_cycle' => "Preparatory cycle 2",
            'speciality_id' => $id_speciality
        ])->id;

        foreach ([1, 2] as $nbre) {
            Semester::create([
                "title_semester" => "Semester $nbre",
                "cycle_id" => $id_cycle
            ]);
        }

        foreach ($request->specialities as $speciality) {
            $id_speciality = Speciality::create([
                'title_specialty' => $speciality,
                'e_n_s_a_id' => $id
            ])->id;

            $id_cycle = Cycle::create([
                'title_cycle' => "Engineering cycle 1",
                'speciality_id' => $id_speciality
            ])->id;

            foreach ([1, 2] as $nbre) {
                Semester::create([
                    "title_semester" => "Semester $nbre",
                    "cycle_id" => $id_cycle
                ]);
            }

            $id_cycle = Cycle::create([
                'title_cycle' => "Engineering cycle 2",
                'speciality_id' => $id_speciality
            ])->id;

            foreach ([1, 2] as $nbre) {
                Semester::create([
                    "title_semester" => "Semester $nbre",
                    "cycle_id" => $id_cycle
                ]);
            }

            $id_cycle = Cycle::create([
                'title_cycle' => "Engineering cycle 3",
                'speciality_id' => $id_speciality
            ])->id;

            foreach ([1, 2] as $nbre) {
                Semester::create([
                    "title_semester" => "Semester $nbre",
                    "cycle_id" => $id_cycle
                ]);
            }
        }

        return ["message" => "ENSA created sucessfully"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ENSA::find($id)->with(["phones", "clubs", "events", "images", "emails"])->first();
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
            'title' => "required|string|max:255",
            'intro' => "required|string",
            'city' => "required|string|max:255",
            'type' => "required|string|max:255",
            'website' => "required|string|max:255",
            'address' => "required|string",
            'campus' => "required|string",
            'restaurants' => "required|string",
            'carte' => "string",
            'initial_education' => "required|string",
            'continuing_education' => "required|string",
            'cooperation' => "string",
            'published' => "required"
        ]);

        $ensa = ENSA::find($id);

        return $ensa->update(array_merge($request->all(), [
            "published" => $request->published == "true"
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ENSA::destroy($id);
    }
}
