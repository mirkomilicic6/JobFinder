@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create new blog post</h1>
@stop

@section('content')
<div class="container">
    {{-- form start --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Create blog post</b></div>

                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="">Blog title</label>
                        <input type="text" class="form-control" name="title">
                        @if($errors->has('title'))
                            <div class="error" style="color: red;">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Blog body</label>
                        <textarea class="form-control" name="body"></textarea>
                        @if($errors->has('body'))
                            <div class="error" style="color: red;">{{ $errors->first('body') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                            <label for="">Blog photo</label>
                            <input type="file" name="blog_photo" class="form-control" id="">
                            @if($errors->has('blog_photo'))
                                <div class="error" style="color: red;">{{ $errors->first('blog_photo') }}</div>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control">
                            <option value="1">Live</option>
                            <option value="0">Draft</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="error" style="color: red;">{{ $errors->first('status') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Create post</button>
                    </div>
                </div>
            </div>

            @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @endif
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
