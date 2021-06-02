@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Question</div>

                <div class="card-body">
                    <h3>{{ $question->title }}</h3>

                    @if ($question->description != "null")
                    <p>{{ $question->description }}</p>
                    @endif

                    @if ($question->image != "null")
                    <img src="/storage/{{ $question->image }}" style="max-width: 100%; border-radius: 5px;">
                    @endif

                    <p class="mt-4"><a href="/profile/{{ $question->user_id }}">User #{{ $question->user_id }}</a> @ {{ $question->created_at }}</p>

                    <a href="/answer/create?question={{ $question->id }}" class="btn btn-primary" role="button" data-bs-toggle="button">Answer Question</a>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Answers</div>

                <div class="card-body">
                @if(count($question->answers) == 0)
                    <p><i>No answers yet</i></p>
                @endif

                @for($i = count($question->answers) - 1; $i >= 0; $i--)
                    <p>{{ $question->answers[$i]->description }}</p>

                    @if($question->answers[$i]->image != "null")
                        <p><a href="/storage/{{ $question->answers[$i]->image }}" target="_blank"><img src="/storage/{{ $question->answers[$i]->image }}" style="max-width: 100px; border-radius: 5px;"></a></p>
                    @endif

                    <p class="mt-2"><a href="/profile/{{ $question->answers[$i]->user_id }}">User #{{ $question->answers[$i]->user_id }}</a> @ {{ $question->answers[$i]->created_at }}</p>

                    @if($i > 0)
                        <hr class="mt-4">
                    @endif
                @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
