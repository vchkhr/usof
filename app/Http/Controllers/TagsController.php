<?php

namespace App\Http\Controllers;

class TagsController extends Controller
{
    public function show()
    {
        $tagRequest = explode(" ", explode("GET /tag/", request())[1])[0];

        return view('tags.show', compact('tagRequest'));
    }
}
