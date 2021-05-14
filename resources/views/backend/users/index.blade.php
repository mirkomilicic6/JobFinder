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
        <th scope="col">User name</th>
        <th scope="col">Email</th>
        <th scope="col">User type</th>
        <th scope="col">Registered at</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($allUsers as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->user_type}}</td>
                <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                <td>
                    <form method="POST" action="{{route('admin.users.destroy', $user->id) }}"  >
                        @method('POST')
                        @csrf
                        <button class="btn btn-danger btn-sm delete-confirm" data-name="{{ $user->name }}" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $allUsers->links() }}

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
