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

                    <ul>
                        @for($i = 0; $i < count($allTags); $i++)
                            <li>
                                <a href="/tag/{{ $allTags[$i]['name'] }}">{{ $allTags[$i]['name'] }}</a>
                                <span class="text-muted">
                                    <span>{{ $allTags[$i]['count'] }} </span>
                                @if($allTags[$i]['count'] <= 1)
                                    <span>question</span>
                                @else
                                    <span>questions</span>
                                @endif
                                </span>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
