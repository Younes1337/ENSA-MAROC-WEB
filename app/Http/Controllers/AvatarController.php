<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'img' => 'image|max:4096',
        ]);

        if (!isset($request->id))
            $id = auth()->user()->id;
        else
            $id = $request->id;

        $user = User::find($id);

        $avatar_path = $user->avatar;
        $avatar = $request->img;
        $name = str_replace(' ', '', $request->first_name . "_" . $request->last_name) . "_avatar" . date_format(date_create(), "YmdHis") . "." . $avatar->extension();
        $avatar->storeAs('/uploads/avatars', $name, 'public');
        $avatar_path = "/storage/uploads/avatars/$name";

        return $user->update(["avatar" => $avatar_path]);
    }
}
