@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profiles</div>

                <div class="card-body">
                    @if(count($usersRating) == 0)
                        <p>No profiles yet</p>
                    @endif

                    @for($i = 0; $i < count($usersRating); $i++)
                        <p class="mb-2">
                            <a href="/profile/{{ $usersRating[$i]['id'] }}">
                                <img src="{{ $users->where('id', $usersRating[$i]['id'])->first()->profile->profileImage() }}" style="width: 15px;" class="rounded-circle">
                                {{ $users->where('id', $usersRating[$i]['id'])->first()->name }}
                            </a>
                            <span>&nbsp;</span>
                            <span class="text-muted"><i class="bi bi-hand-thumbs-up"></i> {{ $usersRating[$i]['rating'] }}</span>
                        </p>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
