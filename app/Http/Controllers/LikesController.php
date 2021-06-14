<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use DB;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function create(Request $request)
    {
        $this->store($request);

        $data = request()->validate([
            'answer' => '',
            'question' => 'required',
            'is_like' => 'required',
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
        ]);

        if (array_key_exists('answer', $data) == true) {
            if (auth()->user()->id == DB::table('answers')->where('id', $data['answer'])->first()->user_id) {
                return;
            }

            if (Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->count() == 0) {
                auth()->user()->likes()->create([
                    'answer_id' => $data['answer'],
                    'is_like' => $data['is_like'],
                ]);
            } else {
                if (Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id], ['is_like', 1]])->count() == 1) {
                    Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 0) {
                        auth()->user()->likes()->create([
                            'answer_id' => $data['answer'],
                            'is_like' => $data['is_like'],
                        ]);
                    }
                } else {
                    Like::where([['answer_id', $data['answer']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 1) {
                        auth()->user()->likes()->create([
                            'answer_id' => $data['answer'],
                            'is_like' => $data['is_like'],
                        ]);
                    }
                }
            }
        }
        else {
            if (auth()->user()->id == DB::table('questions')->where('id', $data['question'])->first()->user_id) {
                return;
            }

            if (Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id]])->count() == 0) {
                auth()->user()->likes()->create([
                    'question_id' => $data['question'],
                    'is_like' => $data['is_like'],
                ]);
            } else {
                if (Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id], ['is_like', 1]])->count() == 1) {
                    Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 0) {
                        auth()->user()->likes()->create([
                            'question_id' => $data['question'],
                            'is_like' => $data['is_like'],
                        ]);
                    }
                } else {
                    Like::where([['question_id', $data['question']], ['user_id', auth()->user()->id]])->delete();

                    if ($data['is_like'] == 1) {
                        auth()->user()->likes()->create([
                            'question_id' => $data['question'],
                            'is_like' => $data['is_like'],
                        ]);
                    }
                }
            }
        }
    }
}
