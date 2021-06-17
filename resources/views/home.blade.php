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
                        <h3>&#x1F525; Questions</h3>

                        @if(count($questionsRating) == 0)
                            <p>No questions yet</p>
                        @endif

                        @for($i = 0; $i < count($questionsRating) && $i < 5; $i++)
                            <div class="question d-flex mt-3 mb-3">
                                <div class="mr-2">
                                    <img src="{{ $users->find($questionsRating[$i]['user_id'])->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                                </div>

                                <div>
                                    <h5>
                                        @if ($questionsRating[$i]['solved'] == 1)
                                            <small class="text-muted"><span class="c-green"><i class="bi-check-circle-fill"></i></span></small>
                                        @endif
                                        <a href="/question/{{ $questionsRating[$i]['id'] }}">{{ $questionsRating[$i]['title'] }}</a> &nbsp; &#x1F44D; {{ App\Http\Controllers\HomeController::calculateHome($questionsRating, $i) }}
                                    </h5>

                                    <p>{{ $questionsRating[$i]['description'] }}</p>

                                    <p class="mb-0">
                                        <a href="/profile/{{ $questionsRating[$i]['user_id'] }}">
                                            <i class="bi bi-person"></i>
                                            <span>{{ $users->find($questionsRating[$i]['user_id'])->name }}</span>
                                            </a>
                                        <span>&nbsp;</span>
                                        <span><i class="bi bi-clock"></i> {{ date("F j, Y, g:i a",strtotime($questionsRating[$i]['created_at'])) }}</span>
                                        <span>&nbsp;</span>
                                        <span title="Question ID"><i class="bi bi-puzzle"></i> {{ $questionsRating[$i]['id'] }}</span>
                                    </p>
                                    
                                    @if ($questionsRating[$i]['tags'] != null)
                                        <p class="mb-0">
                                            <i class="bi bi-tags"></i>
                                            @foreach(explode(",", $questionsRating[$i]['tags']) as $tag)
                                                <a href="/tag/{{ $tag }}"><small class="text-muted">#</small><span>{{ $tag }}</span></a>
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="row justify-content-center">
                        <a class="btn btn-outline-primary mb-5" href="/questions">All Questions</a>
                    </div>

                    <div>
                        <h3>&#x1F525; Tags</h3>

                        @if(count($allTags) == 0)
                            <p>No tags yet</p>
                        @endif

                        @for($i = 0; $i < count($allTags) && $i < 10; $i++)
                            <p class="mb-2">
                                <a href="/tag/{{ $allTags[$i]['name'] }}"><small class="text-muted">#</small><span>{{ $allTags[$i]['name'] }}</span></a>
                                <span>&nbsp;</span>
                                <span class="text-muted">
                                    <span><i class="bi bi-patch-question"></i> {{ $allTags[$i]['count'] }}</span>
                                </span>
                            </p>
                        @endfor
                    </div>

                    <div class="row justify-content-center">
                        <a class="btn btn-outline-primary mb-5" href="/tags">All Tags</a>
                    </div>

                    <div>
                        <h3>&#x1F525; Profiles</h3>

                        @if(count($usersRating) == 0)
                            <p>No profiles yet</p>
                        @endif

                        @for($i = 0; $i < count($usersRating) && $i < 10; $i++)
                            <p class="mb-2">
                                <a href="/profile/{{ $usersRating[$i]['id'] }}">
                                    <img src="{{ $users->find($usersRating[$i]['id'])->profile->profileImage() }}" style="width: 15px;" class="rounded-circle">
                                    {{ $usersRating[$i]['name'] }}
                                </a>
                                <span>&nbsp;</span>
                                <span class="text-muted"><i class="bi bi-hand-thumbs-up"></i> {{ $usersRating[$i]['rating'] }}</span>
                            </p>
                        @endfor
                    </div>

                    <div class="row justify-content-center">
                        <a class="btn btn-outline-primary mb-5" href="/profiles">All Profiles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
