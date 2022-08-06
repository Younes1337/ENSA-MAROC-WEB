<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param mixed $speciality_id
     * @return \Illuminate\Http\Response
     */
    public function index($speciality_id)
    {
        return Cycle::where('speciality_id', $speciality_id)->get();
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
            'title_cycle' => "required|string",
            'speciality_id' => "required",
            'semesters' => "required"
        ]);

        $cycle = Cycle::create($request->all());

        $semesters = ["semester 1", "semester 2"];

        if (!empty($request->semesters)) {
            foreach ($request->semesters as $semester) {
                Semester::create([
                    'title_semester' => $semester,
                    'cycle_id' => $cycle->id
                ]);
            }
        } else {
            foreach ($semesters as $semester) {
                Semester::create([
                    'title_semester' => $semester,
                    'cycle_id' => $cycle->id
                ]);
            }
        }

        return response()->json([
            'message' => 'Cycle created'
        ], 201);
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
