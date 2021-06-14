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
                                    <small class="text-muted">({{ $user->profile->real_name }})</small>
                                @endif

                                <span class="mr-2"></span>
                            </h3>

                            <p class="@if($user->profile->url != null) mb-0 @endif">{{ $user->profile->description }}</p>

                            @if($user->profile->url != null)
                                <p>
                                    <a href="{{ $user->profile->url }}" target="_blank">{{ explode("://", $user->profile->url)[1] }}</small></a>
                                    <small class="text-muted">(external website)</small>
                                </p>
                            @endif

                            @can('update', $user->profile)
                                <a href="/profile/{{ $user->id }}/edit" class="btn btn-primary mb-3" role="button" data-bs-toggle="button">Edit Profile</a>
                            @endcan
                        </div>
                    </div>

                    <div>
                        <h3>Questions</h4>

                        @if(count($user->questions) == 0)
                            <p>No questions yet</p>
                        @endif
                        
                        <ul>
                            @for ($i = count($user->questions) - 1; $i >= 0; $i--)
                                <li><a href="/question/{{ $user->questions[$i]->id }}">{{ $user->questions[$i]->title }}</a> @ {{ $user->questions[$i]->created_at }}</li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
