@extends('layouts.main')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header"><b>All jobs by this company</b></div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <th>Logo</th>
                        <th>Position:</th>
                        <th>Address:</th>
                        <th>Date:</th>
                        <th>Last date to apply</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                        <tr>
                            <td>
                                <img src="{{ asset('avatar/avatar.jpg') }}" width="80">
                            </td>
                            <td>
                                 {{ $job->position }}
                                <br>
                                <i class="fas fa-clock"></i>
                                Fulltime
                            </td>
                            <td><i class="fas fa-map-marker-alt"></i>
                                 {{ $job->address }}
                            </td>
                            <td><i class="fas fa-calendar-week"></i>
                                 {{ $job->created_at->diffForHumans() }}
                            </td>
                            <td>
                                {{ $job->last_date }}
                            </td>
                            <td>
                                <a href="{{ route('jobs.show', [$job->id, $job->slug]) }}">
                                <button class="btn btn-success btn-sm">View</button>
                                </a>
                                <a href="{{ route('jobs.edit', [$job->id, $job->slug]) }}">
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                    </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
</div>
@endsection
