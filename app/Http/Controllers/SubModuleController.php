<?php

namespace App\Http\Controllers;

use App\Models\Element;
use Illuminate\Http\Request;

class SubModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param mixed $id_module
     * @return \Illuminate\Http\Response
     */
    public function index($id_module)
    {
        return Element::where('module_id', $id_module)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return Element::destroy($id);
    }
}
