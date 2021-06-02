@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="d-flex">
                        <div>

                        </div>

                        <div>
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->profile->title }}</p>
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
