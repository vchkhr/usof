<?php

namespace App\Http\Controllers;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function show()
    {
        $tagSearch = explode(" ", explode("GET /tag/", request())[1])[0];
        $questions = [];

        foreach(\App\Models\Question::all() as $question) {
            foreach(explode(",", $question['tags']) as $tag) {
                $tags = explode(",", $question['tags']);

                if (str_replace(" ", "-", $tag) == $tagSearch) {
                    array_push($questions, [
                        'id' => $question->id,
                        'title' => $question->title,
                    ]);
                }
            }
        }

        return view('tags.show', [
            'questions' => $questions,
            'tag' => $tagSearch
        ]);
    }
}
