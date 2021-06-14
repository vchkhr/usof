@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tag</div>

                <div class="card-body">
                    <h3>
                        <small class="text-muted">#</small><span>{{ $tag }}</span>
                    </h3>

                    <ul>
                        @foreach($questions as $question)
                            <li><a href="/question/{{ $question['title'] }}">{{ $question['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
