<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $likes = \App\Models\Like::all();
        $questions = \App\Models\Question::all();
        $users = \App\Models\User::all();

        $allTags = array();
        foreach ($questions as $question) {
            $tags = explode(",", $question->tags);
            foreach ($tags as $tag) {
                if ($tag != "") {
                    $found = false;

                    for ($i = 0; $i < count($allTags); $i++) {
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

        $questionsRating = array();
        foreach($questions as $question) {
            array_push($questionsRating, ['id' => $question->id, 'rating' => 0, 'title' => $question->title, 'created_at' => $question->created_at, 'solved' => $question->solved]);
        }

        foreach($likes as $like) {
            $question_id = $like['question_id'];

            if ($question_id != null) {
                for ($i = 0; $i < count($questionsRating); $i++) {
                    if ($questionsRating[$i]['id'] == $question_id) {
                        if ($like['is_like'] == 1) {
                            $questionsRating[$i]['rating'] += 1;
                        }
                        else {
                            $questionsRating[$i]['rating'] -= 1;
                        }
                    }
                }
            }
        }

        array_multisort(array_column($questionsRating, 'rating'), SORT_DESC, array_column($questionsRating, 'id'), $questionsRating);

        return view('home', compact('user', 'questions', 'users', 'allTags', 'likes', 'questionsRating'));
    }
}
