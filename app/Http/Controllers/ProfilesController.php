<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'real_name' => '',
            'description' => '',
            'url' => '',
            'profile_photo' => '',
        ]);

        if ($data['profile_photo'] == null) {
            $data['profile_photo'] = "null";
        }

        auth()->user()->profile->update($data);

        return redirect("/profile/{$user->id}");
    }
}
