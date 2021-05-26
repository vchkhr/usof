@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Question by @ {{ $post->created_at }}</span>
                </div>

                <div class="card-body">
                    <h4>{{ $post->caption }}</h4>

                    <img src="/storage/{{ $post->image }}" alt="{{ $post->caption }}" style="width: 50%;">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
