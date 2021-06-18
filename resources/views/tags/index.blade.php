@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tags</div>

                <div class="card-body">
                    @if(count($allTags) == 0)
                        <p>No tags yet</p>
                    @endif

                    @for($i = 0; $i < count($allTags); $i++)
                        <p class="mb-2">
                                <a href="/tag/{{ $allTags[$i]['name'] }}"><small class="text-muted">#</small><span>{{ $allTags[$i]['name'] }}</span></a>
                                <span>&nbsp;</span>
                                <span class="text-muted">
                                    <span><i class="bi bi-patch-question"></i> {{ $allTags[$i]['count'] }}</span>
                                </span>
                            </p>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
