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
            'answer' => '',
            'question' => 'required',
            'is_like' => 'required',
            'recipient_id' => 'required',
        ]);

        if (array_key_exists('answer', $data) == true) {
            return redirect('/question/' . $data['question'] . '#answer-' . $data['answer']);
        }
        else {
            return redirect('/question/' . $data['question']);
        }
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'answer' => '',
            'question' => 'required',
            'is_like' => 'required',
            'recipient_id' => 'required',
        ]);

        if (auth()->user()->id == $data['recipient_id']) {
            return;
        }

        if (array_key_exists('answer', $data) == true) {
            if (\App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->count() == 0) {
                auth()->user()->likes()->create([
                    'answer_id' => $data['answer'],
                    'is_like' => $data['is_like'],
                    'recipient_id' => $data['recipient_id'],
                ]);
            } else {
                if (\App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id], ['is_like', 1]])->count() == 1) {
                    \App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 0) {
                        auth()->user()->likes()->create([
                            'answer_id' => $data['answer'],
                            'is_like' => $data['is_like'],
                            'recipient_id' => $data['recipient_id'],
                        ]);
                    }
                } else {
                    \App\Models\Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 1) {
                        auth()->user()->likes()->create([
                            'answer_id' => $data['answer'],
                            'is_like' => $data['is_like'],
                            'recipient_id' => $data['recipient_id'],
                        ]);
                    }
                }
            }
        }
        else {
            if (\App\Models\Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id]])->count() == 0) {
                auth()->user()->likes()->create([
                    'question_id' => $data['question'],
                    'is_like' => $data['is_like'],
                    'recipient_id' => $data['recipient_id'],
                ]);
            } else {
                if (\App\Models\Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id], ['is_like', 1]])->count() == 1) {
                    \App\Models\Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 0) {
                        auth()->user()->likes()->create([
                            'question_id' => $data['question'],
                            'is_like' => $data['is_like'],
                            'recipient_id' => $data['recipient_id'],
                        ]);
                    }
                } else {
                    \App\Models\Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 1) {
                        auth()->user()->likes()->create([
                            'question_id' => $data['question'],
                            'is_like' => $data['is_like'],
                            'recipient_id' => $data['recipient_id'],
                        ]);
                    }
                }
            }
        }
    }
}
