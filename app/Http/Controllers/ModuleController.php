<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Element;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id_semester
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFilter($id_semester)
    {
        return Module::where("id_semester", $id_semester)->get();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Module::with(["semester", "semester.cycle"])->get();
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
            'title_module' => "required|string",
            'module_description' => "required|string",
            'id_semester' => "required",
        ]);

        $module = Module::create($request->all());

        $elements = [];

        if (!empty($request->elements)) {
            foreach ($request->elements as $element) {
                $elements[] = Element::create([
                    'title_element' => $element,
                    'module_id' => $module->id
                ]);
            }
        } else {
            $elements[] = Element::create([
                'title_element' => $module->title_module,
                'module_id' => $module->id
            ]);
        }

        return response()->json_encode([
            'message' => 'Module created',
            'module' => $module,
            'elements' => $elements
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
        return Module::with(['semester', 'documents', 'elements',
                'elements.documents', 'semester.cycle',
                'semester.cycle.speciality.cycle', 'semester.cycle.speciality.ensa'
            ])
            ->where("modules.id", $id)
            ->get()
            ->first();
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
        return Module::destroy($id);
    }
}
