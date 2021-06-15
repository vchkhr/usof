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
                        <h3>Top 10 Questions</h3>

                        @if(count($questionsRating) == 0)
                            <p>No questions yet</p>
                        @endif

                        @for($i = 0; $i < count($questionsRating) && $i < 10; $i++)
                            <a href="/question/{{ $questionsRating[$i]['id'] }}" class="regularText">
                                <div class="question d-flex mt-3 mb-3">
                                    <div class="mr-2">
                                        <img src="{{ $users->find($questionsRating[$i]['user_id'])->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                                    </div>

                                    <div>
                                        <h5>{{ $questionsRating[$i]['title'] }} &nbsp; &#x1F44D; {{ App\Http\Controllers\HomeController::calculateHome($questionsRating, $i) }}</h5>

                                        <p>{{ $questionsRating[$i]['description'] }}</p>

                                        <p class="mb-0">
                                            <a href="/profile/{{ $questionsRating[$i]['user_id'] }}">{{ $users->find($questionsRating[$i]['user_id'])->name }}</a>
                                            <span>@ {{ $questionsRating[$i]['created_at'] }}</span>
                                        </p>
                                        
                                        @if ($questionsRating[$i]['tags'] != null)
                                            <p class="mb-0">
                                                @foreach(explode(",", $questionsRating[$i]['tags']) as $tag)
                                                    <a href="/tag/{{ $tag }}" class="mr-2"><small class="text-muted">#</small><span>{{ $tag }}</span></a>
                                                @endforeach
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endfor
                    </div>

                    <div class="row justify-content-center">
                        <a class="btn btn-outline-primary mb-5" href="/questions">All Questions</a>
                    </div>

                    <div>
                        <h3>Top 10 Tags</h3>

                        @if(count($allTags) == 0)
                            <p>No tags yet</p>
                        @endif

                        <ul>
                            @for($i = 0; $i < count($allTags) && $i < 10; $i++)
                                <li>
                                    <a href="/tag/{{ $allTags[$i]['name'] }}">{{ $allTags[$i]['name'] }}</a>
                                    <span class="text-muted">
                                        <span>{{ $allTags[$i]['count'] }} </span>
                                    @if($allTags[$i]['count'] <= 1)
                                        <span>question</span>
                                    @else
                                        <span>questions</span>
                                    @endif
                                    </span>
                                </li>
                            @endfor
                        </ul>
                    </div>

                    <div class="row justify-content-center">
                        <a class="btn btn-outline-primary mb-5" href="/tags">All Tags</a>
                    </div>

                    <div>
                        <h3>Top 10 Profiles</h3>

                        @if(count($usersRating) == 0)
                            <p>No profiles yet</p>
                        @endif

                        <ul>
                            @for($i = 0; $i < count($usersRating) && $i < 10; $i++)
                                <li>
                                    <a href="/profile/{{ $usersRating[$i]['id'] }}">{{ $usersRating[$i]['name'] }}</a>
                                    <span class="text-muted">rating: {{ $usersRating[$i]['rating'] }}</span>
                                </li>
                            @endfor
                        </ul>
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
