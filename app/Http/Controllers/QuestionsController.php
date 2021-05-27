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
            'image' => 'image'
        ]);

        \App\Models\Post::create(); 

        request()->all();
    }
}
