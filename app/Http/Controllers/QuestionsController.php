<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;

class QuestionsController extends Controller
{
    public function create()
    {
        return view('questions/create');
    }

    public function store(Question $question)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'image|nullable',
            'tags' => 'nullable',
        ]);

        if (array_key_exists('image', $data) == true) {
            $imagePath = request('image')->store('uploads', 'public');
        }
        else {
            $imagePath = null;
        }

        auth()->user()->questions()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $imagePath,
            'tags' => $data['tags'],
        ]);

        return redirect('/question/' . Question::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first()->id);
    }

    public function show(\App\Models\Question $question)
    {
        $user = auth()->user();
        
        return view('questions.show', compact('question', 'user'));
    }

    public function edit(User $user, Question $question)
    {
        $q = Question::find($question['id']);

        if ($q->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('questions.edit', compact('user', 'question'));
    }

    public function update(User $user, Question $question)
    {
        $q = Question::find($question['id']);

        if ($q->user_id !== auth()->user()->id) {
            abort(403);
        }
        
        $data = request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'image|nullable',
            'tags' => 'nullable',
        ]);

        if (array_key_exists('image', $data) == true) {
            $data['image'] = request('image')->store('uploads', 'public');
        }
        else {
            $data['image'] = null;
        }

        Question::find($question['id'])->update($data);

        return redirect("/question/{$question['id']}");
    }
}
