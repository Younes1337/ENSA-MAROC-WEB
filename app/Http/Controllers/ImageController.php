<?php

namespace App\Http\Controllers;

use App\Models\ENSA;
use App\Models\Image;
use App\Models\News;
use App\Models\Website;
use Illuminate\Http\Request;

class ImageController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Image::with('ensa')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $request->model;
        $id = $request->id;

        if($model == "Website")
            $item = Website::find($id);
        elseif ($model == "ENSA") {
            $item = ENSA::find($id);
        } elseif ($model == "News") {
            $item = News::find($id);
        }

        if ($request->hasFile('logo')) {

            $file = $request->file('logo');

            $path = dirname($item->logo_path, 4);
            $save_path = substr($path, 8);

            $name = strtolower($model) . str_replace(' ', '', $request->title) . "_logo" . "." . $file->getClientOriginalExtension();

            $file->storeAs($save_path, $name, 'public');
            $logo_path = $path . "/" . $name;

            return $item->update(["logo" => $logo_path]);
        }

        if($request->hasFile('cover_picture')) {

            $file = $request->file('cover_picture');

            $name = str_replace(' ', '', $request->title) . "_cover_picture" . date_format(date_create(), "YmdHis"). "." . $file->extension();

            $file->storeAs("images/cover_pictures", $name, 'public');
            $coverPicture_path = "/storage/images/cover_pictures/" . $name;

            return $item->update(["cover_picture" => $coverPicture_path]);
        }

        $image_path = $item->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $name = str_replace(' ', '', $request->title) . "_news" . date_format(date_create(), "YmdHis") . "." . $file->extension();
            $file->storeAs('uploads/news', $name, 'public');

            $image_path = "/storage/uploads/news/$name";

            return $item->update(["image" => $image_path]);
        }

        return response()->json([
            'message' => 'No image received',
            404
        ]);
    }

}
