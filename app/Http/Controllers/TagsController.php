<?php

namespace App\Http\Controllers;

use App\Models\Question;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $questions = Question::all();

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

        return view('tags.index', compact('allTags'));
    }

    public function show()
    {
        $tagSearch = explode(" ", explode("GET /tag/", request())[1])[0];
        $questions = [];

        foreach(\App\Models\Question::all() as $question) {
            foreach(explode(",", $question['tags']) as $tag) {
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
