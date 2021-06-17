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

                    @for($i = 0; $i < count($questions); $i++)
                        <div class="question d-flex mt-3 mb-3">
                            <div class="mr-2">
                                <img src="{{ $users->find($questions[$i]['user_id'])->first()->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
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
                                        <span>{{ $users->find($questions[$i]['user_id'])->first()->name }}</span>
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
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
