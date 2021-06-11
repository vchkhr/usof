<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        if ($user->profile == null) {
            Profile::create(['user_id' => $user->id]);

            return redirect('/home');
        }

        return view('profiles.index', compact('user'));
    }

    public function edit(User $user, Profile $profile)
    {
        $this->authorize("update", $user->profile);
        $profile = auth()->user()->profile;

        return view('profiles.edit', compact('user', 'profile'));
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

    public function destroy()
    {
        if (request()->username != auth()->user()->name) {
            return redirect('/profile/' . auth()->user()->id . "/edit");
        }

        DB::table('profiles')->where('user_id', '=', auth()->user()->id)->delete();
        DB::table('questions')->where('user_id', '=', auth()->user()->id)->delete();
        DB::table('answers')->where('user_id', '=', auth()->user()->id)->delete();
        DB::table('likes')->where('user_id', '=', auth()->user()->id)->delete();
        DB::table('likes')->where('recipient_id', '=', auth()->user()->id)->delete();
        DB::table('users')->where('id', '=', auth()->user()->id)->delete();

        return redirect()->route('login');
    }
}
