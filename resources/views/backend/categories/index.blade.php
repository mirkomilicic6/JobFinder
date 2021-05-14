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
        <th scope="col">Category name</th>
        <th scope="col">Created at</th>
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>

        @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <a href="{{ route('backendCategory.edit', $category->id) }}" class="btn btn-warning mb-2">Edit</a>
                    <form method="POST" action="{{ route('backendCategory.destroy', $category->id) }}"  >
                        @method('POST')
                        @csrf
                        <button class="btn btn-danger btn-sm delete-confirm" data-name="{{ $category->name }}" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>

  </table>
  @if(count($categories) < 1)
  <tr>
      <td>
          <h4><b>No categories found. Please add categories first.</b></h4>
      </td>
  </tr>
  @endif

  {{ $categories->links() }}
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
