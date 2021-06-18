@extends('layouts.app')

@section('content')
<div class="container mb-2">
    <div class="row justify-content-center">
        <div style="margin-left: auto; margin-right: auto;">{{ $questions->links() }}</div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Questions</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="sortBy">Order</label>
                        <div class="btn-group ml-2" role="group">
                            <a type="button" 
                                @if ($order == 'oldest')
                                    class="btn btn-outline-primary"
                                @else
                                    class="btn btn-primary"
                                @endif
                            href="/questions?order=Newest">Newest First</a>

                            <a type="button"
                                @if ($order != 'oldest')
                                    class="btn btn-outline-primary"
                                @else
                                    class="btn btn-primary"
                                @endif
                            href="/questions?order=Oldest">Oldest First</a>
                        </div>
                    </div>

                    @if(count($questions) == 0)
                        <p>No questions yet</p>
                    @endif

                    @for($i = 0; $i < count($questions); $i++)
                        <div class="question d-flex mb-3">
                            <div class="mr-2">
                                <img src="{{ $users->where('id', $questions[$i]['user_id'])->first()->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                            </div>

                            <div>
                                <h5>
                                    @if ($questions[$i]['solved'] == 1)
                                        <small class="text-muted"><span class="c-green"><i class="bi-check-circle-fill"></i></span></small>
                                    @endif
                                    <a href="/question/{{ $questions[$i]['id'] }}">{{ $questions[$i]['title'] }}</a> &nbsp; &#x1F44D; {{ App\Http\Controllers\HomeController::calculateHome($questions, $i) }}
                                </h5>

                                <p>{{ $questions[$i]['description'] }}</p>

                                <p class="mb-0">
                                    <a href="/profile/{{ $questions[$i]['user_id'] }}">
                                        <i class="bi bi-person"></i>
                                        <span>{{ $users->where('id', $questions[$i]['user_id'])->first()->name }}</span>
                                        </a>
                                    <span>&nbsp;</span>
                                    <span><i class="bi bi-clock"></i> {{ date("F j, Y, g:i", strtotime($questions[$i]['created_at'])) }}&nbsp;{{ date("a", strtotime($questions[$i]['created_at'])) }}</span>
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
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div style="margin-left: auto; margin-right: auto;">{{ $questions->links() }}</div>
    </div>
</div>
@endsection
