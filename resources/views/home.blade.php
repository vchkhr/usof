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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
