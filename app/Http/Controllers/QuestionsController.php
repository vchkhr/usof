<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Like;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function create()
    {
        return view('questions/create');
    }

    public function store(Question $question)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'image|nullable',
            'tags' => 'nullable',
            'solved' => 'nullable',
        ]);

        if (array_key_exists('image', $data) == true) {
            $imagePath = request('image')->store('uploads', 'public');
        } else {
            $imagePath = null;
        }

        $data['tags'] = $this->checkTags($data['tags']);

        auth()->user()->questions()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $imagePath,
            'tags' => $data['tags'],
            'solved' => 0
        ]);

        return redirect('/question/' . Question::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first()->id);
    }

    public function show(Question $question)
    {
        $user = auth()->user();
        $tags = explode(",", $question->tags);

        $rating = Like::where([['question_id', $question->id], ['is_like', 1]])->count();
        $rating -= Like::where([['question_id', $question->id], ['is_like', 0]])->count();

        $answerCorrect = $question->answers->where('id', $question->correct_answer_id)->first();

        if ($answerCorrect != null) {
            $answerCorrectBool = true;
            $answerCorrectUser = User::where('id', $answerCorrect->user_id)->get()[0];
            $answerCorrectRating = Like::where([['answer_id', $answerCorrect->id], ['is_like', 1]])->count();
            $answerCorrectRating -= Like::where([['answer_id', $answerCorrect->id], ['is_like', 0]])->count();
        } else {
            $answerCorrectBool = false;
            $answerCorrect = $question->answers->first();
            $answerCorrectUser = User::all()->first();
            $answerCorrectRating = 0;
        }

        return view('questions.show', compact('question', 'user', 'answerCorrectBool', 'answerCorrect', 'answerCorrectUser', 'answerCorrectRating', 'tags', 'rating'));
    }

    public function index()
    {
        $questions = Question::where("id", ">", "0")->paginate(10);
        $users = User::all();

        return view('questions.index', compact('questions', 'users'));
    }

    public function edit(User $user, Question $question)
    {
        $q = Question::find($question['id']);

        if (auth()->user()->is_admin == false && auth()->user()->id != $q->user_id) {
            abort(403);
        }

        if (request()->query('markAsSolved') != null) {
            $this->update($user, $question);

            return redirect("/question/{$question['id']}");
        }
        if (request()->query('correctAnswerId') != null) {
            $this->update($user, $question);

            return redirect("/question/{$question['id']}#answer-" . request()->query('correctAnswerId'));
        }

        return view('questions.edit', compact('user', 'question'));
    }

    public function update(User $user, Question $question)
    {
        $q = Question::find($question['id']);

        if (auth()->user()->is_admin == false && auth()->user()->id != $q->user_id) {
            abort(403);
        }

        if (request()->query('markAsSolved') != null) {
            $q->solved = request()->query('markAsSolved') == "true" ? 1 : 0;
            $q->save();

            return;
        }
        if (request()->query('correctAnswerId') != null) {
            if (request()->query('correctAnswerId') == 0) {
                $q->correct_answer_id = null;
            } else {
                $q->correct_answer_id = request()->query('correctAnswerId');
            }

            $q->save();

            return;
        }

        $data = request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'image|nullable',
            'tags' => 'nullable',
            'deleteImage' => 'nullable'
        ]);

        if (array_key_exists('deleteImage', $data) == true) {
            $data['image'] = null;

            unset($data['deleteImage']);
        } else {
            if (array_key_exists('image', $data) == true) {
                $data['image'] = request('image')->store('uploads', 'public');
            } else {
                $data['image'] = $q->image;
            }
        }

        $data['tags'] = $this->checkTags($data['tags']);

        $q->update($data);

        return redirect("/question/{$question['id']}");
    }

    public function destroy($id)
    {
        $question = Question::find($id);

        if (auth()->user()->is_admin == false && auth()->user()->id != $question->user_id) {
            abort(403);
        }

        $answers = Answer::where('question_id', $id)->get();

        foreach ($answers as $answer) {
            Like::where('answer_id', $answer->id)->delete();
            $answer->delete();
        }

        Like::where('question_id', $question->id)->delete();
        $question->delete();

        return redirect()->route('home');
    }

    public static function getUser($question, $i)
    {
        $res = User::where('id', $question->answers[$i]->user_id)->get()[0];

        return $res;
    }

    public static function getProfile($question, $i)
    {
        $res = User::where('id', $question->answers[$i]->user_id)->get()[0]->profile;

        return $res;
    }

    public static function getRating($question, $i)
    {
        $res = Like::where([['answer_id', $question->answers[$i]->id], ['is_like', 1]])->count();
        $res -= Like::where([['answer_id', $question->answers[$i]->id], ['is_like', 0]])->count();

        return $res;
    }

    public function checkTags($tags) {
        if ($tags != null) {
            $allTags = str_replace(" ", "-", $tags);
            $tagsArr = array();

            foreach(explode(",", $allTags) as $tag) {
                array_push($tagsArr, preg_replace('/[^A-Za-z0-9\-]/', '', $tag));
            }

            $tags = implode(",", $tagsArr);
        }

        return $tags;
    }
}
