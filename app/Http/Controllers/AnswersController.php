<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
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
}
