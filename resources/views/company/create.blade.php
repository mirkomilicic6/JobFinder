@extends('layouts.main')

@section('content')
<div class="container">
    @if (Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
    @endif
    <div class="row">

        <div class="col-md-3">
            @if(empty(Auth::user()->company->logo))
            <img src="{{ asset('avatar/avatar.jpg') }}" width="100" style="width: 100%;">
            @else
            <img src="{{ asset('uploads/logo') }}/{{ Auth::user()->company->logo }}" width="100" style="width: 100%;">
            @endif

            <form action="{{ route('company.logo') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card mt-4">
                <div class="card-header"><b>Update company logo</b></div>
                <div class="card-body mt-2">
                    <input type="file" name="logo" class="form-control" id="">
                    <button class="btn btn-success mt-2 float-right" type="submit">Update logo</button>
                    @if($errors->has('logo'))
                            <div class="error" style="color: red;">{{ $errors->first('logo') }}</div>
                    @endif
                </div>
            </div>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><b>Update your company information</b></div>

                <form action="{{ route('company.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ Auth::user()->company->address }}">
                        @if($errors->has('address'))
                            <div class="error" style="color: red;">{{ $errors->first('address') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ Auth::user()->company->phone }}">
                        @if($errors->has('phone'))
                            <div class="error" style="color: red;">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Website</label>
                        <input type="text" class="form-control" name="website" value="{{ Auth::user()->company->website }}">
                        @if($errors->has('website'))
                            <div class="error" style="color: red;">{{ $errors->first('website') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Slogan</label>
                        <input type="text" class="form-control" name="slogan" value="{{ Auth::user()->company->slogan }}">
                        @if($errors->has('slogan'))
                            <div class="error" style="color: red;">{{ $errors->first('slogan') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" value="">{{ Auth::user()->company->description }}</textarea>
                        @if($errors->has('description'))
                            <div class="error" style="color: red;">{{ $errors->first('description') }}</div>
                        @endif
                    </div>



                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><b>Your company information</b></div>
                <div class="card-body">
                    <p><b>Company name:</b> {{ Auth::user()->company->company_name }}</p>
                    <p><b>Company address:</b> {{ Auth::user()->company->address }}</p>
                    <p><b>Company phone:</b> {{ Auth::user()->company->phone }}</p>
                    <p><b>Company website:</b> {{ Auth::user()->company->website }}</p>
                    <p><b>Company slogan:</b> {{ Auth::user()->company->slogan }}</p>
                    <p><b>Company page:</b><a href="{{ route('company.index', [Auth::user()->company->id, Auth::user()->company->slug]) }}"> View page</a></p>
                </div>
            </div>

            <br>
            <form action="{{ route('cover.photo') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card">
                <div class="card-header"><b>Update cover photo</b></div>
                <div class="card-body">
                    <input type="file" name="cover_photo" class="form-control" id="">
                    <button class="btn btn-success mt-2 float-right" type="submit">Update cover photo</button>
                    @if($errors->has('cover_photo'))
                        <div class="error" style="color: red;">{{ $errors->first('cover_photo') }}</div>
                    @endif
                </div>
            </div>
            </form>
            <br>

            <br>

        </div>
    </div>
</div>
@endsection
