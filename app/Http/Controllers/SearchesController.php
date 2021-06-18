<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;

class SearchesController extends Controller
{
    public function index()
    {
        $users = User::all();

        $questionsAll = Question::all();
        $questions = array();
        $errorCode = 0;
        
        $search = request()->q;

        if ($search == null) {
            $errorCode = 1;
        }
        else if (strlen($search) <= 3) {
            $errorCode = 2;
        }
        else {
            $searchProcess = trim(strtolower($search));

            foreach($questionsAll as $question) {
                $title = strtolower($question->title);
                $description = strtolower($question->description);
                
                if (strpos($title, $searchProcess) !== false || strpos($description, $searchProcess) !== false) {
                    array_push($questions, $question);
                    
                    break;
                }
                else {
                    // $answers = $question->answers;
    
                    // foreach($answers as $answer) {
                    //     $description = strtolower($answer->description);
                        
                    //     if (strpos($description, $searchProcess) !== false) {
                    //         array_push($questions, $question);
                    
                    //         break;
                    //     }
                    // }
                }
            }
        }

        return view('searches.index', compact('errorCode', 'questions', 'users'));
    }
}
