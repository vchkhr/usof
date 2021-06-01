@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    <div class="d-flex">
                    </div>

                    <div>
                        <h4>Questions</h4>

                        @if(count($user->questions) == 0)
                            <p>No questions yet</p>
                        @endif
                        
                        <ul>
                        @foreach($user->questions as $question)
                            <li><a href="/question/{{ $question->id }}">{{ $question->title }}</a> @ {{ explode(" ", $question->created_at)[0] }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
