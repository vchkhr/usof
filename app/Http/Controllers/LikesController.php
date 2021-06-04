<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LikeRequest;
use DB;

class LikesController extends Controller
{
    public function create(Request $request)
    {
        $this->store($request);

        $data = request()->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        return redirect('/question/' . $data['question'] . '#answer-' . $data['answer']);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        if (\App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->count() == 0) {
            auth()->user()->likes()->create([
                'answer_id' => $data['answer'],
            ]);
        }
        else {
            \App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->delete();
        }
    }
}
