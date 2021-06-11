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
                        <h3>Top 10 Questions</h4>

                            @if(count($questions) == 0)
                            <p>No questions yet</p>
                            @endif

                            <ul>
                                @for($i = 0; $i < count($questionsRating) && $i < 10; $i++)
                                <li>
                                    <a href="/question/{{ $questionsRating[$i]['id'] }}">{{ $questionsRating[$i]['title'] }}</a>
                                    <span>@ {{ $questionsRating[$i]['created_at'] }}</span>

                                    <span class="text-muted">
                                        <span>rating: {{ \App\Models\Like::where([['question_id', $questionsRating[$i]['id']], ['is_like', 1]])->count() - \App\Models\Like::where([['question_id', $questionsRating[$i]['id']], ['is_like', 0]])->count() }}</span>

                                        @if($questionsRating[$i]['solved'] == 1)
                                        <span>| solved</span>
                                        @endif
                                    </span>
                                </li>
                                @endfor
                            </ul>
                    </div>

                    <div>
                        <h3>Tags</h4>

                            @if(count($allTags) == 0)
                            <p>No tags yet</p>
                            @endif

                            <ul>
                                @for($i = count($allTags) - 1; $i >= 0; $i--)
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

                    <div>
                        <h3>Users</h4>

                            @if(count($users) == 0)
                            <p>No users yet</p>
                            @endif

                            <ul>
                                @for($i = count($users) - 1; $i >= 0; $i--)
                                <li>
                                    <a href="/profile/{{ $users[$i]->id }}">{{ $users[$i]->name }}</a>
                                    <span class="text-muted">rating: {{ \App\Models\Like::where('recipient_id', $users[$i]->id)->count() }}</span>
                                </li>
                                @endfor
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
