<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        foreach ($users as $user)
            $user->{"role"} = $user->hasRole("moderator") ? "moderator" : "admin";
        return $users;
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
        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'phone_number' => 'required|string',
            'role' => 'string',
            'e_n_s_a_id' => 'required'
        ]);

        $user = User::find($id);

        $currentUser = $request->user();

        $avatar_path = $user->avatar;

        if ($currentUser->hasRole("admin")) {
            $rolesArray = ["admin", "moderator"];

            if (!in_array($request["role"], $rolesArray)) {
                abort(403, "missed role");
            }

            $user->assignRole($request["role"]);

            return $user->update(array_merge($fields, [
                'password' => bcrypt($fields["password"]),
                'avatar' => $avatar_path
            ]));
        }

        return response()->json(["message" => "you are not an admin"], 401);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
