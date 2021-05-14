@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Deleted posts</h1>
@stop

@section('content')

    @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif

<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Post title</th>
        <th scope="col">Post body</th>
        <th scope="col">Post image</th>
        <th scope="col">Post status</th>
        <th scope="col">Deleted at</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>

    <tbody>

         @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{str_limit($post->body, 20)}}</td>
                <td><img src="{{asset('uploads/blog/photos')}}/{{$post->blog_photo}}" width="70" height="70"></td>
                <td>
                    @if($post->status == '0')
                       <a href="" class="badge badge-primary">Draft</a>
                    @else
                        <a href="" class="badge badge-success">Live</a>
                    @endif
                </td>
                <td>{{ $post->deleted_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('blog.restore', $post->id) }}"><button class="btn btn-success" type="submit">Restore</button></a>
                </td>
            </tr>

        @endforeach

    </tbody>
  </table>
  @if(count($posts) < 1)
  <tr>
      <td>
          <h4><b>Trash empty.</b></h4>
      </td>
  </tr>
  @endif
  {{ $posts->links() }}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
