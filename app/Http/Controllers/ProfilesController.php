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
        $this->authorize("update", $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'real_name' => 'nullable',
            'description' => 'nullable',
            'url' => 'url|nullable',
            'profile_photo' => 'image|nullable',
            'deletePhoto' => 'nullable',
        ]);

        if (array_key_exists('deletePhoto', $data) == true) {
            $data['profile_photo'] = null;
        }
        else {
            if (array_key_exists('profile_photo', $data) == true) {
                $data['profile_photo'] = request('profile_photo')->store('uploads', 'public');
            }
            else {
                $data['profile_photo'] = auth()->user()->profile->profile_photo;
            }
        }

        auth()->user()->profile->update($data);

        return redirect("/profile/{$user->id}");
    }
}
