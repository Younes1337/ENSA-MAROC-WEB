<?php

namespace App\Http\Controllers;

use App\Models\News;
use DateTime;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return News::all();
    }

    /**
     * Display latest News.
     *
     * @return \Illuminate\Http\Response
     */
    public function latestNews()
    {
        $latestNews = News::orderBy('created_at', "DESC")
                        ->take(6)
                        ->get();
        return $latestNews;
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
        $fields = $request->validate([
            'title' => "required|string|max:40",
            'description' => "required|string",
            'short_description' => "required|string|max:100",
            'e_n_s_a_id' => "required",
        ]);

        $image_path = '/storage/uploads/news/news-1.png';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = str_replace(' ', '', $request->title) . "_news" . date_format(date_create(), "YmdHis") . "." . $file->extension();
            $file->storeAs('uploads/news', $name, 'public');
            $image_path = "/storage/uploads/news/$name";
        }

        return News::create(array_merge($fields, [
            "image" => $image_path,
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return News::find($id);
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
        $fields = $request->validate([
            'title' => "required|string|max:40",
            'description' => "required|string",
            'short_description' => "required|string|max:100",
            'e_n_s_a_id' => "required",
        ]);

        $news = News::find($id);

        return $news->update($fields);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return News::destroy($id);
    }
}
