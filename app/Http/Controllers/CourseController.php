<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param int $id_module
    *
    * @return \Illuminate\Http\Response
    */
    public function indexFilter($id_module)
    {
        return Document::where("module_id", $id_module)->get();
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
            'doc_type' => "required|string",
            'doc_title' => "required|string",
            'doc_link' => "required|string",
            'element_id' => "required",
            'module_id' => "required"
        ]);

        return Document::create($request->all());
    }

}
