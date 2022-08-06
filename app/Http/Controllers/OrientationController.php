<?php

namespace App\Http\Controllers;

use App\Models\Orientations;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class OrientationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Orientations::all();
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFilter($ensa, $level)
    {
        return Orientations::where('e_n_s_a_id', "=", $ensa)
            ->where('level_exam', "=", $level)
            ->get();
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
            'title_exam' => "required|string|max:255",
            'level_exam' => ["required", "string", "max:60", ValidationRule::in("Baccalaureate", "Baccalaureate +2")],
            'link_exam' => "required|string",
            'e_n_s_a_id' => "required"
        ]);

        return Orientations::create($request->all());
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
            'title_exam' => "required|string|max:255",
            'level_exam' => ["required", "string", "max:60", ValidationRule::in("Baccalaureate", "Baccalaureate +2")],
            'link_exam' => "required|string",
            'e_n_s_a_id' => "required"
        ]);

        $orientation = Orientations::find($id);

        return $orientation->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Orientations::destroy($id);
    }
}
