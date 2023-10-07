<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return response()->json($user);
    }

    function getProfile(Request $request, User $user)
    {
        $username = $request->username;
        $user = User::where('name', $username)->first();
        return response()->json([
            "name" => $user->name,
            "bio" => $user->bio,
            "image" => $user->image,
            "following" => $user->following,
        ]);
    }

    function followUser(Request $request, User $user)
    {
        $username = $request->username;
        $user = User::where('name', $username)->first();
        $user->following = true;
        $user->save();
        return response()->json([
            "name" => $user->name,
            "bio" => $user->bio,
            "image" => $user->image,
            "following" => $user->following,
        ]);
    }

    function unfollowUser(Request $request, User $user)
    {
        $username = $request->username;
        $user = User::where('name', $username)->first();
        $user->following = false;
        $user->save();
        return response()->json([
            "name" => $user->name,
            "bio" => $user->bio,
            "image" => $user->image,
            "following" => $user->following,
        ]);
    }
}
