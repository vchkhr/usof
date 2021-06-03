@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile #{{ $user->id }}</div>

                <div class="card-body">
                    <div class="d-flex">
                        <div>

                        </div>

                        <div class="d-flex">
                            @if($user->profile->profile_photo != null)
                            <div class="mr-2">
                                <a href="/storage/{{ $user->profile->profile_photo }}" target="_blank">
                                    <img src="/storage/{{ $user->profile->profile_photo }}" style="width: 25px;">
                                </a>
                            </div>
                            @endif

                            <div>
                                <h3>
                                    <span>{{ $user->name }}</span>

                                    @if($user->profile->real_name != null)
                                        <small class="text-muted">({{ $user->profile->real_name }})</small>
                                    @endif
                                </h3>

                                <p class="@if($user->profile->url != null) mb-0 @endif">{{ $user->profile->description }}</p>

                                @if($user->profile->url != null)
                                <a href="{{ $user->profile->url }}" target="_blank">
                                    <p>{{ explode("://", $user->profile->url)[1] }}</p>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        @can('update', $user->profile)
                        <p><a href="/profile/{{ $user->id }}/edit" class="btn btn-primary" role="button" data-bs-toggle="button">Edit Profile</a></p>
                        @endcan
                    </div>

                    <div>
                        <h4>Questions</h4>

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
