@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile #{{ $user->id }}</div>

                <div class="card-body">
                    <form method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="real_name" class="col-md-4 col-form-label text-md-right">Real Name</label>

                            <div class="col-md-6">
                                <input id="real_name" type="text" class="form-control @error('real_name') is-invalid @enderror" name="real_name" value="{{ old('real_name') ?? $user->profile->real_name }}" autocomplete="real_name" autofocus>

                                @error('real_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description }}" autocomplete="description">

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label text-md-right">Web-Site</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url">

                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_photo" class="col-md-4 col-form-label text-md-right">Profile Photo</label>

                            <div class="col-md-6">
                                <input id="profile_photo" type="file" class="form-control-file @error('profile_photo') is-invalid @enderror" name="profile_photo" value="{{ old('profile_photo') }}">

                                @error('profile_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deletePhoto" class="col-md-4 col-form-label text-md-right">Delete Profile Photo</label>

                            <div class="col-md-6">
                                <input id="deletePhoto" type="checkbox" class="@error('deletePhoto') is-invalid @enderror" name="deletePhoto" value="" style="margin-top: 12px;">

                                @error('deletePhoto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="alert alert-danger mt-5" role="alert">
                        <strong>Danger Zone!</strong>

                        <p>To delete your profile enter <strong>{{ $user->name }}</strong> and press "Delete Profile". This will delete all your data, including profile's data, questions, answers and their materials, such as images.</p>

                        <form method="POST" action="{{ route('profile.destroy', ['id' => $profile->id]) }}">
                        @csrf
                        @method('DELETE')

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror " name="username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger">
                                        Delete Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
