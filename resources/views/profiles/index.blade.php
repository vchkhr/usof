@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile #{{ $user->id }}</div>

                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-2">
                            <a href="{{ $user->profile->profileImage() }}" target="_blank">
                                <img src="{{ $user->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                            </a>
                        </div>

                        <div>
                            <h3>
                                <span>{{ $user->name }}</span>

                                @if($user->profile->real_name != null)
                                    <small class="text-muted">{{ $user->profile->real_name }}</small>
                                @endif

                                @if($user->is_admin == true)
                                    <small class="text-muted">admin</small>
                                @endif

                                <small>
                                    <span>&nbsp;</span>
                                    <i class="bi bi-hand-thumbs-up"></i><span> {{ $rating }}</span>
                                    <span>&nbsp;</span>
                                    <i class="bi bi-patch-question"></i><span> {{ count($user->questions) }}</span>
                                    <span>&nbsp;</span>
                                    <i class="bi bi-vector-pen"></i><span> {{ count($user->answers) }}</span>
                                </small>

                                <span class="mr-2"></span>
                            </h3>

                            <h5>
                                
                            </h5>

                            <p class="@if($user->profile->url != null) mb-0 @endif">{{ $user->profile->description }}</p>

                            @if($user->profile->url != null)
                                <p>
                                    <a href="{{ $user->profile->url }}" target="_blank">{{ explode("://", $user->profile->url)[1] }}</small></a>
                                    <small class="text-muted">
                                        @if($urlProtocol == 'http')
                                            <span style="color: red;">unsecure</span>
                                        @endif

                                        @if($urlDomain != env('APP_NAME', ''))
                                            <span>external website</span>
                                        @endif
                                    </small>
                                </p>
                            @endif

                            @if(auth()->user()->is_admin == true || $user->id == auth()->user()->id)
                                <a href="/profile/{{ $user->id }}/edit" class="btn btn-primary mb-3" role="button" data-bs-toggle="button">Edit Profile</a>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3">
                        <h3>Questions</h4>

                        @if(count($user->questions) == 0)
                            <p>No questions yet</p>
                        @endif
                        
                        @for ($i = count($user->questions) - 1; $i >= 0; $i--)
                            <div class="question d-flex mt-3 mb-3">
                                <div class="mr-2">
                                    <img src="{{ $user->profile->profileImage() }}" style="width: 35px;" class="rounded-circle">
                                </div>

                                <div>
                                    <h5>
                                        @if ($user->questions[$i]['solved'] == 1)
                                            <small class="text-muted"><span class="c-green"><i class="bi-check-circle-fill"></i></span></small>
                                        @endif
                                        <a href="/question/{{ $user->questions[$i]['id'] }}">{{ $user->questions[$i]['title'] }}</a> &nbsp; &#x1F44D; {{ App\Http\Controllers\HomeController::calculateHome($user->questions, $i) }}
                                    </h5>

                                    <p>{{ $user->questions[$i]['description'] }}</p>

                                    <p class="mb-0">
                                        <a href="/profile/{{ $user->questions[$i]['user_id'] }}">
                                            <i class="bi bi-person"></i>
                                            <span>{{ $user->name }}</span>
                                            </a>
                                        <span>&nbsp;</span>
                                        <span><i class="bi bi-clock"></i> {{ date("F j, Y, g:i a",strtotime($user->questions[$i]['created_at'])) }}</span>
                                        <span>&nbsp;</span>
                                        <span title="Question ID"><i class="bi bi-puzzle"></i> {{ $user->questions[$i]['id'] }}</span>
                                    </p>
                                    
                                    @if ($user->questions[$i]['tags'] != null)
                                        <p class="mb-0">
                                            <i class="bi bi-tags"></i>
                                            @foreach(explode(",", $user->questions[$i]['tags']) as $tag)
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
</div>
@endsection
