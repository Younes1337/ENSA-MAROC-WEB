<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public static function upload(Request $request)
    {
        $id_ensa = $request->id;

        $files = $request->file("ensasImages");

        $count = count($files);

        $allowedfileExtension=['jpeg', 'jpg', 'png'];
        $errors = [];

        for ($i = 0; $i < $count; $i++) {

            $extension = $files[$i]->getClientOriginalExtension();

            $check = in_array($extension, $allowedfileExtension);

            if ($check) {

                $name = $id_ensa . "_image" . $i+1 . date_create();
                $path = $files[$i]->storeAs("ensasImages", $name, "public");

            } else {
                return response()->json(['invalid_file_format'], 422);
            }
        }

        return response()->json(['files_uploaded'], 200);
    }
}
