@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errorCode > 0)
                    <div class="card-header">Search Failed</div>
                @else
                    <div class="card-header">Questions with "{{ request()->q }}"</div>
                @endif

                <div class="card-body">
                    @if ($errorCode == 1)
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-info-circle"></i> To use search enter search phrase in the input and press "Search" button.<br>You have entered an empty phrase.
                        </div>
                    @elseif ($errorCode == 2)
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-circle"></i> Search phrase should be more than 3 symbols.
                        </div>
                    @elseif (count($questions) == 0)
                        <p>No questions yet</p>
                    @endif

                    @for($i = 0; $i < count($questions); $i++)
                        <a href="/question/{{ $questions[$i]['id'] }}" class="regularText">
                            <div class="question d-flex mb-3">
                                <div class="mr-2">
                                    <img src="{{ $users->find($questions[$i]['user_id'])->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                                </div>

                                <div>
                                    <h5>
                                        @if ($questions[$i]['solved'] == 1)
                                            <small class="text-muted"><span class="c-green"><i class="bi-check-circle-fill"></i></span></small>
                                        @endif

                                        {{ $questions[$i]['title'] }} &nbsp; &#x1F44D; {{ App\Http\Controllers\HomeController::calculateHome($questions, $i) }}
                                    </h5>

                                    <p>{{ $questions[$i]['description'] }}</p>

                                    <p class="mb-0">
                                        <a href="/profile/{{ $questions[$i]['user_id'] }}">
                                            <i class="bi bi-person"></i>
                                            <span>{{ $users->find($questions[$i]['user_id'])->name }}</span>
                                            </a>
                                        <span>&nbsp;</span>
                                        <span><i class="bi bi-clock"></i> {{ date("F j, Y, g:i a",strtotime($questions[$i]['created_at'])) }}</span>
                                        <span>&nbsp;</span>
                                        <span title="Question ID"><i class="bi bi-puzzle"></i> {{ $questions[$i]['id'] }}</span>
                                    </p>
                                    
                                    @if ($questions[$i]['tags'] != null)
                                        <p class="mb-0">
                                            <i class="bi bi-tags"></i>
                                            @foreach(explode(",", $questions[$i]['tags']) as $tag)
                                                <a href="/tag/{{ $tag }}"><small class="text-muted">#</small><span>{{ $tag }}</span></a>
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endfor

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
