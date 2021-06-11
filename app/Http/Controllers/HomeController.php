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
        $users = \App\Models\User::all();
        $likes = \App\Models\Like::all();
        
        $allTags = array();
        foreach($questions as $question) {
            $tags = explode(",", $question->tags);
            foreach($tags as $tag) {
                if ($tag != "" && !in_array($tag, $allTags)) {
                    array_push($allTags, $tag);
                }
            }
        }

        return view('home', compact('user', 'questions', 'users', 'allTags', 'likes'));
    }
}
