@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tag</div>

                <div class="card-body">
                    <h3>
                        <small class="text-muted">#</small>
                        <span>{{ $tagRequest }}</span>
                    </h3>

                    <ul>
                        @foreach(\App\Models\Question::all() as $question)
                            @foreach(explode(",", $question['tags']) as $tag)
                                @if(str_replace(" ", "-", $tag) == $tagRequest)
                                    <li><a href="/question/{{ $question->id }}">{{ $question['title'] }}</a></li>
                                @endif
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
