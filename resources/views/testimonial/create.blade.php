@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create new testimonial</h1>
@stop

@section('content')
<div class="container">
    {{-- form start --}}
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header"><b>Please fill out  the form</b></div>

                <form action="{{ route('testimonial.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label for="">Testimonial content</label>
                        <textarea class="form-control" name="content"></textarea>
                        @if($errors->has('content'))
                            <div class="error" style="color: red;">{{ $errors->first('content') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                        @if($errors->has('name'))
                            <div class="error" style="color: red;">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Profession</label>
                        <input type="text" class="form-control" name="profession">
                        @if($errors->has('profession'))
                            <div class="error" style="color: red;">{{ $errors->first('profession') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Video id</label>
                        <input type="text" class="form-control" name="video_id">
                        @if($errors->has('video_id'))
                            <div class="error" style="color: red;">{{ $errors->first('video_id') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>
            </div>


        </form>
        </div>
    </div>
</div>
    {{-- form end --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
