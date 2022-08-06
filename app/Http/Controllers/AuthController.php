<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Nette\Utils\Image;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar' => 'image|max:4096',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'phone_number' => 'required|string|unique:users,phone_number',
            'role' => 'required|string',
            'e_n_s_a_id' => 'required'
        ]);

        $avatar_path = "/uploads/avatars/default.png";
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = str_replace(' ', '', $request->first_name . "_" . $request->last_name) . "_avatar" . date_format(date_create(), "YmdHis") . "." . $avatar->extension();
            $avatar->storeAs('/uploads/avatars', $name, 'public');
            $avatar_path = "/storage/uploads/avatars/$name";
        }

        $user = User::create(array_merge($fields, [
            'password' => bcrypt($fields["password"]),
            'avatar' => $avatar_path
        ]));

        $rolesArray = ["admin", "moderator"];

        if (!in_array($request["role"], $rolesArray)) {
            abort(403, "missed role");
        }

        $user->assignRole($request["role"]);

        return response()->json(['message' => "user registered"]);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // check email
        $user = User::where("email", $fields["email"])->get()->first();

        if (Auth::attempt($request->only('email', 'password'))) {
            $to = $user->hasRole("moderator") ? "moderator" : "admin";
            $request->session()->regenerate();
            return response()->json([
                "auth" => Auth::user(),
                'to' => $to
            ], 200);
        }

        throw ValidationException::withMessages([
            'message' => ['The provided credentials are incorrect.']
        ]);

        // $token = $user->createToken('ensaToken')->plainTextToken;

    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => "user logged out"], 201);
    }
}
