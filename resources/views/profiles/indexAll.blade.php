@extends('layouts.app')

@section('content')
<div class="container mb-2">
    <div class="row justify-content-center">
        <div style="margin-left: auto; margin-right: auto;">{{ $profiles->links() }}</div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">profiles</div>

                <div class="card-body">
                    @if(count($profiles) == 0)
                        <p>No profiles yet</p>
                    @endif

                    <p>
                        @for($i = 0; $i < count($profiles); $i++)
                            <a href="/profile/{{ $profiles[$i]->user_id }}">
                                <img src="{{ $profiles[$i]->profileImage() }}" style="width: 1em; margin-bottom: 2px;" class="rounded-circle">
                                <span>{{ $profiles[$i]->user->name }}</span>
                            </a>
                            <br>
                        @endfor
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div style="margin-left: auto; margin-right: auto;">{{ $profiles->links() }}</div>
    </div>
</div>
@endsection
