<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $questions = \App\Models\Question::all();

        return view('home', compact('user', 'questions'));
    }
}
