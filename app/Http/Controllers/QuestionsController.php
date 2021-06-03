<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{

    public function create()
    {
        return view('questions/create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'string|nullable',
            'image' => 'image|nullable',
        ]);

        if (array_key_exists('image', $data) == true) {
            $imagePath = request('image')->store('uploads', 'public');
        }
        else {
            $imagePath = "null";
        }

        auth()->user()->questions()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Question $question)
    {
        return view('questions.show', compact('question'));
    }
}
