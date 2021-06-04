@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Question #{{ $question->id }}</div>

                <div class="card-body">
                    <h3>{{ $question->title }}</h3>

                    @if ($question->description != null)
                    <p>{{ $question->description }}</p>
                    @endif

                    @if ($question->image != null)
                    <a href="/storage/{{ $question->image }}" target="_blank">
                        <img src="/storage/{{ $question->image }}" style="max-width: 100%; border-radius: 5px;">
                    </a>
                    @endif

                    <p class="mt-4">
                        <a href="/profile/{{ $question->user_id }}">
                            <img src="{{ $question->user->profile->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">

                            <span>{{ $question->user->name }}</span>
                        </a>

                        <span>@ {{ $question->created_at }}</span>
                    </p>

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

                @for($i = 0; $i < count($question->answers); $i++)
                <p class="@if ($i > 0) mt-3 @endif">{{ $question->answers[$i]->description }}</p>

                @if($question->answers[$i]->image != null)
                <p>
                    <a href="/storage/{{ $question->answers[$i]->image }}" target="_blank">
                        <img src="/storage/{{ $question->answers[$i]->image }}" style="max-width: 100px; border-radius: 5px;">
                    </a>
                </p>
                @endif

                <p class="mt-2">
                    <a href="/profile/{{ $question->answers[$i]->user_id }}">
                        <img src="{{ \App\Models\User::where('id', $question->answers[$i]->user_id)->get()[0]->profile->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">
                        {{ \App\Models\User::where('id', $question->answers[$i]->user_id)->get()[0]->name }}
                    </a>
                    <span>@ {{ $question->answers[$i]->created_at }}</span>
                </p>

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
