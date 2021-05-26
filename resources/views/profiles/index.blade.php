@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Profile</span>
                </div>

                <div class="card-body">
                    <h3>{{ $user->username }}</h3>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>{{ $user->name }} has {{ $user->posts->count() }} question{{ $user->posts->count() > 1 ? 's' : '' }}.</p>

                    <p>
                        <a href="/post/create" class="btn btn-primary" role="button">Add New Question</a>
                        <a href="/profile/{{ $user->id }}/edit" class="btn btn-secondary" role="button">Edit Profile</a>
                    </p>

                    <h4 class="pt-4">User's questions:</h4>
                    
                    @foreach($user->posts as $post)
                        <p class="mt-3"><a href="/post/{{ $post->id }}">{{ $post->caption }}</a> @ {{ $post->created_at }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
