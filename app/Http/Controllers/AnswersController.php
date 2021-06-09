<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use DB;

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

    // public function edit(User $user, Question $question)
    // {
    //     $q = Question::find($question['id']);

    //     if ($q->user_id !== auth()->user()->id) {
    //         abort(403);
    //     }

    //     if (request()->query('markAsSolved') != null) {
    //         $this->update($user, $question);

    //         return redirect("/question/{$question['id']}");
    //     }

    //     return view('questions.edit', compact('user', 'question'));
    // }

    // public function update(User $user, Question $question)
    // {
    //     $q = Question::find($question['id']);

    //     if ($q->user_id !== auth()->user()->id) {
    //         abort(403);
    //     }

    //     if (request()->query('markAsSolved') != null) {
    //         $q->solved = request()->query('markAsSolved') == "true" ? 1 : 0;
    //         $q->save();

    //         return;
    //     }
        
    //     $data = request()->validate([
    //         'title' => 'required',
    //         'description' => 'nullable',
    //         'image' => 'image|nullable',
    //         'tags' => 'nullable',
    //         'deleteImage' => 'nullable'
    //     ]);

    //     if (array_key_exists('deleteImage', $data) == true) {
    //         $data['image'] = null;

    //         unset($data['deleteImage']);
    //     }
    //     else {
    //         if (array_key_exists('image', $data) == true) {
    //             $data['image'] = request('image')->store('uploads', 'public');
    //         }
    //         else {
    //             $data['image'] = $q->image;
    //         }
    //     }

    //     if ($data['tags'] != null) {
    //         $data['tags'] = str_replace(" ", "-", $data['tags']);
    //     }

    //     $q->update($data);

    //     return redirect("/question/{$question['id']}");
    // }

    public function destroy($id)
    {
        $answer = Answer::find($id);
        $question = $answer->question_id;

        $answer->delete();

        return redirect('/question/' . $question);
    }
}
