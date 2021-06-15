@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Questions with "{{ request()->q }}"</div>

                <div class="card-body">
                    @if(count($questions) == 0)
                        <p>No questions yet</p>
                    @endif

                    <ul>
                        @for($i = 0; $i < count($questions); $i++)
                            <li>
                                <a href="/question/{{ $questions[$i]['id'] }}">{{ $questions[$i]['title'] }}</a>
                                <span>@ {{ $questions[$i]['created_at'] }}</span>

                                <span class="text-muted">
                                    <span>rating: {{ App\Http\Controllers\HomeController::calculateHome($questions, $i) }}</span>

                                    @if($questions[$i]['solved'] == 1)
                                        <span>| solved</span>
                                    @endif
                                </span>
                            </li>
                        @endfor
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
