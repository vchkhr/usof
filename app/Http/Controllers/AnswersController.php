<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Like;
use App\Models\Image;

use Illuminate\Support\Facades\Storage;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function create()
    {
        return view('answers.create');
    }

    public function store()
    {
        $data = request()->validate([
            'description' => 'required',
            'image' => 'image|nullable',
            'question_id' => 'required',
        ]);

        if (array_key_exists('image', $data) == true) {
            // $imagePath = request('image')->store('uploads', 'public');

            $path = request('image')->storePublicly('images', 's3');
                
            $image = Image::create([
                'filename' => basename($path),
                'url' => Storage::disk('s3')->url($path)
            ]);

            $imagePath = $image->id;
        }
        else {
            $imagePath = null;
        }

        auth()->user()->answers()->create([
            'question_id' => $data['question_id'],
            'description' => $data['description'],
            'image' => $imagePath,
        ]);

        return redirect('/question/' . $data['question_id']);
    }

    public function edit(User $user, Answer $answer)
    {
        $a = Answer::find($answer['id']);
        $image = Image::find($a->image)->url;

        if (auth()->user()->is_admin == false && auth()->user()->id != $a->user_id) {
            abort(403);
        }

        if ($a->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('answers.edit', compact('user', 'answer', 'image'));
    }

    public function update(User $user, Answer $answer)
    {
        $a = Answer::find($answer['id']);
        $question = $a->question_id;

        if (auth()->user()->is_admin == false && auth()->user()->id != $a->user_id) {
            abort(403);
        }

        if ($a->user_id !== auth()->user()->id) {
            abort(403);
        }

        $data = request()->validate([
            'description' => 'string',
            'image' => 'image|nullable',
            'deleteImage' => 'nullable'
        ]);

        if (array_key_exists('deleteImage', $data) == true) {
            $data['image'] = null;

            unset($data['deleteImage']);
        }
        else {
            if (array_key_exists('image', $data) == true) {
                // $data['image'] = request('image')->store('uploads', 'public');

                $path = request('image')->storePublicly('images', 's3');
                    
                $image = Image::create([
                    'filename' => basename($path),
                    'url' => Storage::disk('s3')->url($path)
                ]);
    
                $data['image'] = $image->id;
            }
            else {
                $data['image'] = $a->image;
            }
        }

        $a->update($data);

        return redirect('/question/' . $question  . "#answer-" . $a->id);
    }

    public function destroy($id)
    {
        $answer = Answer::find($id);
        $question = $answer->question_id;

        if (auth()->user()->is_admin == false && auth()->user()->id != $answer->user_id) {
            abort(403);
        }

        foreach(Like::where('answer_id', $id)->get() as $like) {
            app('App\Http\Controllers\LikesController')->destroy($like->id);
        }

        if ($answer->image != null) {
            $image = Image::find($answer->image);
            Storage::disk('s3')->delete('images/' . $image->filename);
            $image->delete();
        }

        $answer->delete();

        return redirect('/question/' . $question);
    }
}
