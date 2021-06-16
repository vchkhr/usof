@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Question #{{ $question->id }}</div>

                <div class="card-body">
                    <a href="/question/{{ $question->id }}" class="regularText">
                        <div class="question d-flex mb-3">
                            <div class="mr-2">
                                <img src="{{ $question->user->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                            </div>

                            <div>
                                <h5>
                                    @if ($question->solved == 1)
                                        <small class="text-muted"><span class="c-green"><i class="bi-check-circle-fill"></i></span></small>
                                    @endif

                                    <span>{{ $question->title }} &nbsp; &#x1F44D; {{ $rating }}</span>

                                    @if(isset($user) && $user->id != $question->user_id)
                                        @if(\App\Models\Like::where([['question_id', $question->id], ['user_id', $user->id]])->count() == 0)
                                            <a href="/like/create?question={{ $question->id }}&is_like=1"><i class="bi bi-caret-up"></i></a>
                                            <a href="/like/create?question={{ $question->id }}&is_like=0"><i class="bi bi-caret-down"></i></a>
                                        @else
                                            @if(\App\Models\Like::where([['question_id', $question->id], ['user_id', $user->id]])->get()[0]->is_like == 1)
                                                <a href="/like/create?question={{ $question->id }}&is_like=1"><i class="bi bi-caret-up-fill"></i></a>
                                                <a href="/like/create?question={{ $question->id }}&is_like=0"><i class="bi bi-caret-down"></i></a>
                                            @else
                                                <a href="/like/create?question={{ $question->id }}&is_like=1"><i class="bi bi-caret-up"></i></a>
                                                <a href="/like/create?question={{ $question->id }}&is_like=0"><i class="bi bi-caret-down-fill"></i></a>
                                            @endif
                                        @endif
                                    @endif
                                </h5>

                                <p>{{ $question->description }}</p>

                                @if ($question->image != null)
                                    <a href="/storage/{{ $question->image }}" target="_blank">
                                        <img src="/storage/{{ $question->image }}" style="max-width: 100%; border-radius: 5px;">
                                    </a>
                                @endif

                                <p class="mb-0">
                                    <a href="/profile/{{ $question->user_id }}">
                                        <i class="bi bi-person"></i>
                                        <span>{{ $question->user->name }}</span>
                                        </a>
                                    <span>&nbsp;</span>
                                    <span><i class="bi bi-clock"></i> {{ date("F j, Y, g:i a",strtotime($question->created_at)) }}</span>
                                    <span>&nbsp;</span>
                                    <span title="Question ID"><i class="bi bi-puzzle"></i> {{ $question->id }}</span>
                                </p>
                                
                                @if ($question->tags != null)
                                    <p class="mb-0">
                                        <i class="bi bi-tags"></i>
                                        @foreach(explode(",", $question->tags) as $tag)
                                            <a href="/tag/{{ $tag }}"><small class="text-muted">#</small><span>{{ $tag }}</span></a>
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>

                    @if (isset($user) && $question->solved == 0)
                        <a href="/answer/create?question={{ $question->id }}" class="btn btn-outline-success" role="button" data-bs-toggle="button"><i class="bi bi-vector-pen"></i> Answer Question</a>

                        @if (isset($user) && $question->user_id == $user['id'])
                            <a href="/question/{{ $question->id }}/edit" class="btn btn-outline-primary" role="button" data-bs-toggle="button"><i class="bi bi-pencil-square"></i> Edit Question</a>
                        @endif
                    @endif

                    @if (isset($user) && ($question->user_id == $user['id'] || $user->is_admin == true))
                        @if ($question->solved == 0)
                            <a href="/question/{{ $question->id }}/edit?markAsSolved=true" class="btn btn-outline-warning" role="button" data-bs-toggle="button"><span class="c-green"><i class="bi-check-circle-fill"></i></span> Mark as Solved</a>
                        @else
                            <a href="/question/{{ $question->id }}/edit?markAsSolved=false" class="btn btn-outline-warning" role="button" data-bs-toggle="button"><i class="bi bi-x-square"></i> Mark as Unsolved</a>
                        @endif

                        <form class="d-inline" method="POST" action="{{ route('question.destroy', ['id' => $question->id]) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete Question</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($answerCorrect != null)
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Correct Answer</div>

                <div class="card-body">
                    <a name="answer-correct"></a>

                    <div class="answer d-flex mb-3">
                        <div class="mr-2">
                            <img src="{{ $answerCorrectUser->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                        </div>

                        <div>
                            <p>
                                <span>{{ $answerCorrect->description }} &nbsp; &#x1F44D; {{ $answerCorrect->rating }}</span>
                                @if(isset($user) && $user->id != $answerCorrect->user_id)
                                    @if(\App\Models\Like::where([['answer_id', $answerCorrect->id], ['user_id', $user->id]])->count() == 0)
                                        <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=1"><i class="bi bi-caret-up"></i></a>
                                        <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=0"><i class="bi bi-caret-down"></i></a>
                                    @else
                                        @if(\App\Models\Like::where([['answer_id', $answerCorrect->id], ['user_id', $user->id]])->get()[0]->is_like == 1)
                                            <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=1">unlike</a>
                                            <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=0">dislike</a>
                                        @else
                                            <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=1">like</a>
                                            <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=0">undislike</a>
                                        @endif
                                    @endif
                                @endif
                            </p>

                            @if ($answerCorrect->image != null)
                                <a href="/storage/{{ $answerCorrect->image }}" target="_blank">
                                    <img src="/storage/{{ $answerCorrect->image }}" style="max-width: 100px; border-radius: 5px;">
                                </a>
                            @endif

                            <p class="mb-0">
                                <a href="/profile/{{ $answerCorrectUser->id }}">
                                    <i class="bi bi-person"></i>
                                    <span>{{ $answerCorrectUser->profile->user->name }}</span>
                                    </a>
                                <span>&nbsp;</span>
                                <span><i class="bi bi-clock"></i> {{ date("F j, Y, g:i a",strtotime($answerCorrect->created_at)) }}</span>
                                <span>&nbsp;</span>
                                <span title="Question ID"><i class="bi bi-puzzle"></i> {{ $answerCorrect->id }}</span>
                            </p>
                            
                            @if ($answerCorrect->tags != null)
                                <p class="mb-0">
                                    <i class="bi bi-tags"></i>
                                    @foreach(explode(",", $answerCorrect->tags) as $tag)
                                        <a href="/tag/{{ $tag }}"><small class="text-muted">#</small><span>{{ $tag }}</span></a>
                                    @endforeach
                                </p>
                            @endif
                        </div>
                    </div>




                    <p>{{ $answerCorrect->description }}</p>

                    @if($answerCorrect->image != null)
                        <p>
                            <a href="/storage/{{ $answerCorrect->image }}" target="_blank">
                                <img src="/storage/{{ $answerCorrect->image }}" style="max-width: 100px; border-radius: 5px;">
                            </a>
                        </p>
                    @endif

                    <p class="mt-2 mb-0">
                        <a href="/profile/{{ $answerCorrect->user_id }}">
                            <img src="{{ $answerCorrectUser->profile->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">
                            {{ $answerCorrectUser->name }}
                        </a>
                        <span>@ {{ $answerCorrect->created_at }}</span>
                        <small class="text-muted">ID: {{ $answerCorrect->id }}</small>
                    </p>

                    <p>
                        <span>Rating:</span>
                        <span>{{ $answerCorrectRating }}</span>

                        @if(isset($user) && $user->id != $answerCorrect->user_id)
                            @if(\App\Models\Like::where([['answer_id', $answerCorrect->id], ['user_id', $user->id]])->count() == 0)
                                <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=1">like</a>
                                <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=0">dislike</a>
                            @else
                                @if(\App\Models\Like::where([['answer_id', $answerCorrect->id], ['user_id', $user->id]])->get()[0]->is_like == 1)
                                    <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=1">unlike</a>
                                    <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=0">dislike</a>
                                @else
                                    <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=1">like</a>
                                    <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}&is_like=0">undislike</a>
                                @endif
                            @endif
                        @endif
                    </p>

                    @if (isset($user) && $answerCorrect->user_id == $user->id)
                        <a href="/answer/{{ $answerCorrect->id }}/edit" class="btn btn-primary" role="button" data-bs-toggle="button">Edit Answer</a>
                    @endif

                    @if (isset($user) && ($question->user_id == $user->id || $user->is_admin == true))
                        <a href="/question/{{ $question->id }}/edit?correctAnswerId=0" class="btn btn-outline-danger" role="button" data-bs-toggle="button">Unmark as Correct</a>
                    @endif

                    @if (isset($user) && $answerCorrect->user_id == $user->id)
                        <form class="d-inline" method="POST" action="{{ route('answer.destroy', ['id' => $answerCorrect->id]) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete Answer</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Answers</div>

                <div class="card-body">
                    @if(count($question->answers) == 0)
                        <p><i>No answers yet</i></p>
                    @endif

                    @for($i = 0; $i < count($question->answers); $i++)
                        <a name="answer-{{ $question->answers[$i]->id }}"></a>
                        <p class="@if ($i > 0) mt-3 @endif">{{ $question->answers[$i]->description }}</p>

                        @if($question->answers[$i]->image != null)
                            <p>
                                <a href="/storage/{{ $question->answers[$i]->image }}" target="_blank">
                                    <img src="/storage/{{ $question->answers[$i]->image }}" style="max-width: 100px; border-radius: 5px;">
                                </a>
                            </p>
                        @endif

                        <p class="mt-2 mb-0">
                            <a href="/profile/{{ $question->answers[$i]->user_id }}">
                                <img src="{{ App\Http\Controllers\QuestionsController::getProfile($question, $i)->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">
                                {{ App\Http\Controllers\QuestionsController::getUser($question, $i)->name }}
                            </a>
                            <span>@ {{ $question->answers[$i]->created_at }}</span>
                            <small class="text-muted">ID: {{ $question->answers[$i]->id }}</small>
                        </p>

                        <p>
                            <span>Rating:</span>
                            <span>{{ App\Http\Controllers\QuestionsController::getRating($question, $i) }}</span>

                            @if(isset($user) && $user->id != $question->answers[$i]->user_id)
                                    @if(\App\Models\Like::where([['answer_id', $question->answers[$i]->id], ['user_id', $user->id]])->count() == 0)
                                    <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}&is_like=1">like</a>
                                    <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}&is_like=0">dislike</a>
                                @else
                                    @if(\App\Models\Like::where([['answer_id', $question->answers[$i]->id], ['user_id', $user->id]])->get()[0]->is_like == 1)
                                        <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}&is_like=1">unlike</a>
                                        <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}&is_like=0">dislike</a>
                                    @else
                                        <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}&is_like=1">like</a>
                                        <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}&is_like=0">undislike</a>
                                    @endif
                                @endif
                            @endif

                            @if(\App\Models\Answer::where('id', $question->correct_answer_id)->count() > 0 && $answerCorrect->id == $question->answers[$i]->id)
                                <span><br>Correct answer</span>
                            @endif
                        </p>

                        @if (isset($user) && $question->answers[$i]->user_id == $user->id)
                            <a href="/answer/{{ $question->answers[$i]->id }}/edit" class="btn btn-primary" role="button" data-bs-toggle="button">Edit Answer</a>
                        @endif

                        @if (isset($user) && ($question->user_id == $user->id || $user->is_admin == true))
                            @if (!$question->correct_answer_id || $question->correct_answer_id != $question->answers[$i]->id)
                                <a href="/question/{{ $question->id }}/edit?correctAnswerId={{ $question->answers[$i]->id }}" class="btn btn-outline-warning" role="button" data-bs-toggle="button">Mark as Correct</a>
                            @else
                                <a href="/question/{{ $question->id }}/edit?correctAnswerId=0" class="btn btn-outline-danger" role="button" data-bs-toggle="button">Unmark as Correct</a>
                            @endif
                        @endif

                        @if (isset($user) && ($question->answers[$i]->user_id == $user->id || $user->is_admin == true))
                            <form class="d-inline" method="POST" action="{{ route('answer.destroy', ['id' => $question->answers[$i]->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete Answer</button>
                            </form>
                        @endif

                        @if($i < count($question->answers) - 1)
                            <hr class="mt-4">
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
