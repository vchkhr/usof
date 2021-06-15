<?php

namespace App\Http\Controllers;

use App\Models\Question;

class SearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $questionsAll = Question::all();
        $questions = array();
        
        $search = request()->q;

        foreach($questionsAll as $question) {
            $title = strtolower($question->title);
            $description = strtolower($question->description);
            
            if (strpos($title, strtolower($search)) !== false || strpos($description, strtolower($search)) !== false) {
                array_push($questions, $question);
                
                break;
            }
            else {
                $answers = $question->answers;

                foreach($answers as $answer) {
                    $description = strtolower($answer->description);
                    
                    if (strpos($description, strtolower($search)) !== false) {
                        array_push($questions, $question);
                
                        break;
                    }
                }
            }
        }

        return view('searches.index', compact('questions'));
    }
}
