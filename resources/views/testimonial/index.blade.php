@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Testimonial</h1>
@stop

@section('content')
    @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th scope="col">Content</th>
        <th scope="col">Name</th>
        <th scope="col">Profession</th>
        <th scope="col">Video id</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($testimonials as $testimonial)
            <tr>
                <td>{{$testimonial->content}}</td>
                <td>{{$testimonial->name}}</td>
                <td>{{ $testimonial->profession }}</td>
                <td>{{ $testimonial->video_id }}</td>
            </tr>
        @endforeach
    </tbody>

  </table>
  @if(count($testimonials) < 1)
  <tr>
      <td>
          <h4><b>No testimonials found. Please add them first.</b></h4>
      </td>
  </tr>
  @endif

  {{ $testimonials->links() }}
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
