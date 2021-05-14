@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Jobs</h1>
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
        <th scope="col">Created at</th>
        <th scope="col">Position</th>
        <th scope="col">Company</th>
        <th scope="col">Last date to apply</th>
        <th scope="col">Job status</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($jobs as $job)
            <tr>
                <th>{{ date('d-m-Y', strtotime($job->created_at)) }}</th>
                <td>{{$job->position}}</td>
                <td>{{ $job->company->company_name }}</td>
                <td>{{ $job->last_date }}</td>
                <td>
                    @if($job->status == '0')
                       <a href="{{ route('admin.getAllJobs.toggle', $job->id) }}" class="badge badge-primary">Draft</a>
                    @else
                        <a href="{{ route('admin.getAllJobs.toggle', $job->id) }}" class="badge badge-success">Live</a>
                    @endif
                </td>
                <td>
                   <a href="{{ route('jobs.show',[$job->id, $job->slug]) }}" target="_blank">Read</a>
                </td>
            </tr>
        @endforeach
    </tbody>

  </table>
  @if(count($jobs) < 1)
  <tr>
      <td>
          <h4><b>No jobs found. Please add jobs first.</b></h4>
      </td>
  </tr>
  @endif

  {{ $jobs->links() }}
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
