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
                    

                    <p class="mt-4"><a href="/profile/{{ $question->user_id }}">User {{ $question->user_id }}</a> @ {{ $question->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
