<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Eval_;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::with('ensa')->get();
        foreach ($clubs as $o) {
            $title = $o->ensa->title;
            unset($o->ensa);
            $o->{"ensa"} = $title;
        }
        return $clubs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => "required|string|max:40",
            'image' => "image|max:4096",
            'description' => "required|string",
            'short_description' => "required|string|max:100",
            'category' => "required|string",
            'e_n_s_a_id' => "required"
        ]);

        $image_path = '/storage/uploads/clubs/default.jpg';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = str_replace(' ', '', $request->title) . "_club" . date_format(date_create(), "YmdHis") . "." . $file->extension();
            $file->storeAs('uploads/clubs', $name, 'public');
            $image_path = "/storage/uploads/clubs/$name";
        }

        return Club::create(array_merge($request->all(), ['image' => $image_path]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Club::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        // $request->validate([
        //     'title' => "required|string|max:255",
        //     'description' => "required|string",
        //     'category' => "required|string",
        //     'e_n_s_a_id' => "required"
        // ]);

        $club = Club::find($id);

        $image_path = $club->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = str_replace(' ', '', $request->title) . "_club" . date_format(date_create(), "YmdHis").".$file->extension()";
            $file->storeAs('uploads/clubs', $name, 'public');
            $image_path = '/storage/uploads/clubs/' . $name;
        }

        return $club->update($request->all() + ["image" => $image_path]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Club::destroy($id);
    }
}
