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
                if ($tag != "") {
                    // if (in_array($tag, $allTags)) {
                    //     dd("a");
                    // }
                    // else {
                    //     array_push($allTags, ['name' => $tag, 'count' => 0]);
                    // }

                    $found = false;

                    for($i = 0; $i < count($allTags); $i++) {
                        if ($tag == $allTags[$i]['name']) {
                            $allTags[$i]['count'] += 1;
                            $found = true;
                            break;
                        }
                    }

                    if ($found == false) {
                        array_push($allTags, ['name' => $tag, 'count' => 1]);
                    }
                }
            }
        }

        return view('home', compact('user', 'questions', 'users', 'allTags', 'likes'));
    }
}
