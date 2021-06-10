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
            'is_like' => 'required',
            'recipient_id' => 'required',
        ]);

        return redirect('/question/' . $data['question'] . '#answer-' . $data['answer']);
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'question' => 'required',
            'answer' => 'required',
            'is_like' => 'required',
            'recipient_id' => 'required',
        ]);

        if (auth()->user()->id == $data['recipient_id']) {
            return;
        }

        if ($data['is_like'] == 1) {
            if (\App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id], ['is_like', $data['is_like']]])->count() == 0) {
                auth()->user()->likes()->create([
                    'answer_id' => $data['answer'],
                    'is_like' => $data['is_like'],
                    'recipient_id' => $data['recipient_id'],
                ]);
            }
            else {
                \App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id], ['is_like', $data['is_like']]])->delete();
            }
        }
    }
}
