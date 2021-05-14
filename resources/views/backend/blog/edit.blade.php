@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit blog post</h1>
@stop

@section('content')
<div class="container">
    {{-- form start --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Edit blog post</b></div>

                <form action="{{ route('blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="">Blog title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                        @if($errors->has('title'))
                            <div class="error" style="color: red;">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Blog body</label>
                        <textarea class="form-control" name="body">{{ $post->body }}</textarea>
                        @if($errors->has('body'))
                            <div class="error" style="color: red;">{{ $errors->first('body') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                            <label for="">Current blog photo</label>
                            <img src="{{asset('uploads/blog/photos')}}/{{$post->blog_photo}}" width="300" height="200">
                            <input type="file" name="blog_photo" class="form-control" id="">
                            @if($errors->has('blog_photo'))
                                <div class="error" style="color: red;">{{ $errors->first('blog_photo') }}</div>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control">
                            <option value="1"{{$post->status=='1'?'selected':''}}>Live</option>
                            <option value="0"{{$post->status=='0'?'selected':''}}>Draft</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="error" style="color: red;">{{ $errors->first('status') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Save edited post</button>
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
