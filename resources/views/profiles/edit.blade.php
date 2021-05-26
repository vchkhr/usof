@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Edit Profile</span>
                </div>

                <div class="card-body">
                    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">Name</label>

                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label">Image</label>

                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                    @error('image')
                                    <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-8 offset-2">
                                <div class="form-group row">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
