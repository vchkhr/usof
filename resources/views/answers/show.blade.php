@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Answer</div>

                <div class="card-body">
                    <p>{{ $question->title }}</p>

                    @if ($question->description != "null")
                    <p>{{ $question->description }}</p>
                    @endif

                    @if ($question->image != "null")
                    <img src="/storage/{{ $question->image }}" style="max-width: 100%; border-radius: 5px;">
                    @endif

                    <p class="mt-4"><a href="/profile/{{ $question->user_id }}">User #{{ $question->user_id }}</a> @ {{ $question->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
