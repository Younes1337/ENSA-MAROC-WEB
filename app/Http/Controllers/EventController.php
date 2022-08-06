<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('ensa')->get();
        foreach ($events as $o) {
            $title = $o->ensa->title;
            unset($o->ensa);
            $o->{"ensa"} = $title;
        }
        return $events;
    }


    /**
     * Display latest News.
     *
     * @return \Illuminate\Http\Response
     */
    public function latestEvents()
    {
        $latestNews = Event::orderBy('created_at', "DESC")
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
        $request->validate([
            'title' => "required|string|max:90",
            'image' => "required|image|max:4096",
            'description' => "required|string",
            'short_description' => "required|string|max:255",
            'city' => "required|string",
            'tags' => "required",
            'start_at' => "required",
            'end_at'  => "required",
            'e_n_s_a_id' => "required"
        ]);

        $image_path = '/storage/uploads/events/default.jpg';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $title = str_replace(' ', '', $request->title);
            $name =  $title . "_event" . date_format(date_create(), "YmdHis") . "." . $extension;
            $file->storeAs('uploads/events', $name, 'public');
            $image_path = "/storage/uploads/events/$name";
        }

        return Event::create(array_merge($request->all(), [
            "image" => $image_path,
            "tags" => join(", ", $request->tags)
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
        return Event::find($id);
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
        //
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
