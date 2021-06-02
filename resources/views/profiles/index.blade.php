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

                        <div>
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->profile->real_name }}</p>
                            <p>{{ $user->profile->description }}</p>
                            <p>{{ $user->profile->url }}</p>
                            <p>{{ $user->profile->profile_photo }}</p>

                            <p><a href="/profile/{{ $user->id }}/edit" class="btn btn-primary" role="button" data-bs-toggle="button">Edit Profile</a></p>
                        </div>
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
