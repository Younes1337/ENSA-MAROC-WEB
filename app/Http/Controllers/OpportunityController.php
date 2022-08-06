<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class OpportunityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Opportunity::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexJobs(Request $request)
    {
        $request->validate([
            "contract" => ["string", ValidationRule::in('Part-time', 'Full-time', 'Freelance', 'Study contract')],
            "date" => "date",
            "city" => "string",
            "title" => "string"
        ]);

        $filter_data = [
            "date" => $request->route()->parameter('date'),
            "city" => $request->get("city"),
            "type" => $request->get("contract"),
            "title" => $request->get("title")
        ];

        $jobs = Opportunity::where("typeO", '=', "job")
            ->SearchCity($filter_data["city"])
            ->SearchDate($filter_data["date"])
            ->SearchContract($filter_data["type"])
            ->SearchTitle($filter_data["title"])
            ->get();


        // if(isset($filter_data["date"])) {
        //     $jobs = $jobs->whereDate('created_at', $filter_data["date"]);
        // }

        // foreach ($filter_data as $key => $value) {
        //     if ($key != "date")
        //         $jobs = $jobs->where($key, 'like', "%$value%");
        // }

        return $jobs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexInternships()
    {
        return Opportunity::where("typeO", '=', "internship")->get();
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
            'description' => "required|string|max:255",
            'city' => "required|string|max:255",
            'country' => "required|string|max:255",
            'typeO' => ["required", "string", "max:60", ValidationRule::in('job', 'internship')],
            'type' => ["required", "string", "max:60", ValidationRule::in('Part-time', 'Full-time', 'Freelance', 'Study contract')],
        ]);

        return Opportunity::create($request->all());
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
