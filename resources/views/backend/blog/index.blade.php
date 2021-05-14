@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
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
        <th scope="col">Date</th>
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
                       <a href="{{ route('blog.toggle', $post->id) }}" class="badge badge-primary">Draft</a>
                    @else
                        <a href="{{ route('blog.toggle', $post->id) }}" class="badge badge-success">Live</a>
                    @endif
                </td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-warning mb-2">Edit</a>
                    <form method="POST" action="{{ route('blog.destroy', $post->id) }}"  >
                        @method('POST')
                        @csrf
                        <button class="btn btn-danger btn-sm delete-confirm" data-name="{{ $post->title }}" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>

  </table>
  @if(count($posts) < 1)
  <tr>
      <td>
          <h4><b>No posts found. Please add posts first.</b></h4>
      </td>
  </tr>
  @endif

  {{ $posts->links() }}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
$('.delete-confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to delete ${name}?`,
          text: "If you delete this, it will be gone forever.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
  });
</script>
@stop
