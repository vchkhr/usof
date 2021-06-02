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

                        @if(count($questions) == 0)
                            <p>No questions yet</p>
                        @endif
                        
                        <ul>
                        @for($i = count($questions) - 1; $i >= 0; $i--)
                            <li><a href="/question/{{ $questions[$i]->id }}">{{ $questions[$i]->title }}</a> @ {{ explode(" ", $questions[$i]->created_at)[0] }}</li>
                        @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
