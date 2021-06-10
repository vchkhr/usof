@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Question #{{ $question->id }}</div>

                <div class="card-body">
                    <h3>
                        <span>{{ $question->title }}</span>
                        @if ($question->solved == 1)
                        <small class="text-muted">solved</small>
                        @endif
                    </h3>

                    @if ($question->description != null)
                    <p>{{ $question->description }}</p>
                    @endif

                    @if ($question->image != null)
                    <a href="/storage/{{ $question->image }}" target="_blank">
                        <img src="/storage/{{ $question->image }}" style="max-width: 100%; border-radius: 5px;">
                    </a>
                    @endif

                    <p class="mt-4 mb-0">
                        <a href="/profile/{{ $question->user_id }}">
                            <img src="{{ $question->user->profile->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">

                            <span>{{ $question->user->name }}</span>
                        </a>

                        <span>@ {{ $question->created_at }}</span>
                    </p>

                    @if ($question->tags != null)
                    <p>
                        @foreach(explode(",", $question->tags) as $tag)
                        <a href="/tag/{{ str_replace(' ', '-', $tag) }}" class="mr-2">#{{ $tag }}</a>
                        @endforeach
                    </p>
                    @endif

                    @if (isset($user) && $question->solved == 0)
                    <a href="/answer/create?question={{ $question->id }}" class="btn btn-success" role="button" data-bs-toggle="button">Answer Question</a>

                    @if (isset($user) && $question->user_id == $user['id'])
                    <a href="/question/{{ $question->id }}/edit" class="btn btn-primary" role="button" data-bs-toggle="button">Edit Question</a>
                    @endif
                    @endif

                    @if (isset($user) && $question->user_id == $user['id'])
                    @if ($question->solved == 0)
                    <a href="/question/{{ $question->id }}/edit?markAsSolved=true" class="btn btn-warning" role="button" data-bs-toggle="button">Mark as Solved</a>
                    @else
                    <a href="/question/{{ $question->id }}/edit?markAsSolved=false" class="btn btn-warning" role="button" data-bs-toggle="button">Mark as Unsolved</a>
                    @endif

                    <form style="display: inline;" method="POST" action="{{ route('question.destroy', ['id' => $question->id]) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete Question</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($question->correct_answer_id != null && \App\Models\Answer::where('id', $question->correct_answer_id)->count() > 0)
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Correct Answer</div>

                <div class="card-body">
                    <a name="answer-correct"></a>

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
                            <img src="{{ \App\Models\User::where('id', $answerCorrect->user_id)->get()[0]->profile->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">
                            {{ \App\Models\User::where('id', $answerCorrect->user_id)->get()[0]->name }}
                        </a>
                        <span>@ {{ $answerCorrect->created_at }}</span>
                    </p>

                    <p>
                        <span>Likes:</span>
                        <span>{{ \App\Models\Like::where('answer_id', $answerCorrect->id)->count() }}</span>

                        @if( isset($user) && \App\Models\Like::where([['answer_id', $answerCorrect->id], ['user_id', $user->id]])->count() == 0 )
                        <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}">like</a>
                        @else
                        <a href="/like/create?question={{ $question->id }}&answer={{ $answerCorrect->id }}">unlike</a>
                        @endif
                    </p>

                    @if (isset($user) && $answerCorrect->user_id == $user->id)
                    <a href="/answer/{{ $answerCorrect->id }}/edit" class="btn btn-primary" role="button" data-bs-toggle="button">Edit Answer</a>
                    @endif

                    @if (isset($user) && $question->user_id == $user->id)
                    <a href="/question/{{ $question->id }}/edit?correctAnswerId={{ $answerCorrect->id }}" class="btn btn-warning" role="button" data-bs-toggle="button">Mark as Correct</a>
                    @endif

                    @if (isset($user) && $answerCorrect->user_id == $user->id)
                    <form style="display: inline;" method="POST" action="{{ route('answer.destroy', ['id' => $answerCorrect->id]) }}">
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
                            <img src="{{ \App\Models\User::where('id', $question->answers[$i]->user_id)->get()[0]->profile->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">
                            {{ \App\Models\User::where('id', $question->answers[$i]->user_id)->get()[0]->name }}
                        </a>
                        <span>@ {{ $question->answers[$i]->created_at }}</span>
                    </p>

                    <p>
                        <span>Likes:</span>
                        <span>{{ \App\Models\Like::where('answer_id', $question->answers[$i]->id)->count() }}</span>

                        @if( isset($user) && \App\Models\Like::where([['answer_id', $question->answers[$i]->id], ['user_id', $user->id]])->count() == 0 )
                        <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}">like</a>
                        @elseif(isset($user))
                        <a href="/like/create?question={{ $question->id }}&answer={{ $question->answers[$i]->id }}">unlike</a>
                        @endif
                        
                        @if(\App\Models\Answer::where('id', $question->correct_answer_id)->count() > 0) && $answerCorrect->id == $question->answers[$i]->id)
                        <span><br>Correct answer</span>
                        @endif
                    </p>

                    @if (isset($user) && $question->answers[$i]->user_id == $user->id)
                    <a href="/answer/{{ $question->answers[$i]->id }}/edit" class="btn btn-primary" role="button" data-bs-toggle="button">Edit Answer</a>
                    @endif

                    @if (isset($user) && $question->user_id == $user->id)
                    <a href="/question/{{ $question->id }}/edit?correctAnswerId={{ $question->answers[$i]->id }}" class="btn btn-warning" role="button" data-bs-toggle="button">Mark as Correct</a>
                    @endif

                    @if (isset($user) && $question->answers[$i]->user_id == $user->id)
                    <form style="display: inline;" method="POST" action="{{ route('answer.destroy', ['id' => $question->answers[$i]->id]) }}">
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
