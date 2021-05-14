@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->profile->avatar))
            <img src="{{ asset('avatar/avatar.jpg') }}" width="100" style="width: 100%;">
            @else
            <img src="{{ asset('uploads/avatar') }}/{{ Auth::user()->profile->avatar }}" width="100" style="width: 100%;">
            @endif
            <form action="{{ route('avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card mt-4">
                <div class="card-header"><b>Update profile picture</b></div>
                <div class="card-body mt-2">
                    <input type="file" name="avatar" class="form-control" id="">
                    <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    @if($errors->has('avatar'))
                            <div class="error" style="color: red;">{{ $errors->first('avatar') }}</div>
                    @endif
                </div>
            </div>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><b>Update your profile</b></div>

                <form action="{{ route('profile.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ Auth::user()->profile->address }}">
                        @if($errors->has('address'))
                            <div class="error" style="color: red;">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Phone number</label>
                        <input type="text" class="form-control" name="phone_number" value="{{ Auth::user()->profile->phone_number }}">
                        @if($errors->has('phone_number'))
                            <div class="error" style="color: red;">{{ $errors->first('phone_number') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Experience</label>
                        <textarea name="experience" class="form-control">{{ Auth::user()->profile->experience }}</textarea>
                        @if($errors->has('experience'))
                            <div class="error" style="color: red;">{{ $errors->first('experience') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Bio</label>
                        <input type="text" class="form-control" name="bio" value="{{ Auth::user()->profile->bio }}">
                        @if($errors->has('bio'))
                            <div class="error" style="color: red;">{{ $errors->first('bio') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
            </div>
            @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @endif
        </div>
    </form>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><b>Your information</b></div>
                <div class="card-body">
                    <p><b>Name:</b> {{ Auth::user()->name }}</p>
                    <p><b>Email:</b> {{ Auth::user()->email }}</p>
                    <p><b>Address:</b> {{ Auth::user()->profile->address }}</p>
                    <p><b>Phone number:</b> {{ Auth::user()->profile->phone_number }}</p>
                    <p><b>Gender:</b> {{ Auth::user()->profile->gender }}</p>
                    <p><b>Experience:</b> {{ Auth::user()->profile->experience }}</p>
                    <p><b>Bio:</b> {{ Auth::user()->profile->bio }}</p>
                    <p><b>Member since:</b> {{ date('F d. Y.',strtotime(Auth::user()->profile->created_at)) }}</p>

                    @if (!empty(Auth::user()->profile->cover_letter))
                        <p><a href="{{ Storage::url(Auth::user()->profile->cover_letter) }}">Cover letter</a></p>
                    @else
                        <p><b>Please upload your cover letter.</b></p>
                    @endif

                    @if (!empty(Auth::user()->profile->resume))
                        <p><a href="{{ Storage::url(Auth::user()->profile->resume) }}">Resume</a></p>
                    @else
                        <p><b>Please upload your resume.</b></p>
                    @endif
                </div>
            </div>

            <br>
            <form action="{{ route('cover.letter') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card">
                <div class="card-header"><b>Update cover letter</b></div>
                <div class="card-body">
                    <input type="file" name="cover_letter" class="form-control" id="">
                    <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    @if($errors->has('cover_letter'))
                        <div class="error" style="color: red;">{{ $errors->first('cover_letter') }}</div>
                    @endif
                </div>
            </div>
            </form>
            <br>
            <form action="{{ route('resume') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card">
                <div class="card-header"><b>Update resume</b></div>
                <div class="card-body">
                    <input type="file" name="resume" class="form-control" id="">
                    <button class="btn btn-success mt-2 float-right" type="submit">Update</button>
                    @if($errors->has('resume'))
                        <div class="error" style="color: red;">{{ $errors->first('resume') }}</div>
                    @endif
                </div>
            </div>
            </form>
            <br>

        </div>
    </div>
</div>
@endsection
