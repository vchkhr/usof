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
        dd(request()->all());
    }
}
