<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show()
    {
        return view('tags.show');
    }
}
