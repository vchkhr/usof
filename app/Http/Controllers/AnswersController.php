<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Like;

class AnswersController extends Controller
{
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
            $imagePath = request('image')->store('uploads', 'public');
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

        if ($a->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('answers.edit', compact('user', 'answer'));
    }

    public function update(User $user, Answer $answer)
    {
        $a = Answer::find($answer['id']);
        $question = $a->question_id;

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
                $data['image'] = request('image')->store('uploads', 'public');
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

        Like::where('answer_id', $id)->delete();

        $answer->delete();

        return redirect('/question/' . $question);
    }
}
