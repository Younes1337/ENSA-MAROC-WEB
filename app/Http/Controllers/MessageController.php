<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Message::all();
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
            'content' => "required|string|max:255",
            'sender_firstName' => "required|string|max:60",
            'sender_lastName' => "required|string|max:60",
            'email' => "required|email|string|max:255",
            'sender_type' => ["required", "string", "max:60", Rule::in('ENSA student', 'External student', 'Other', 'ENSA Professor', 'External Professor')],
            'date_time_sent' => "required|date|max:60"
        ]);

        Message::create($request->all());

        return response()->json([
            'message' => 'Message received',
            201
        ]);
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
        return Message::destroy($id);
    }
}
