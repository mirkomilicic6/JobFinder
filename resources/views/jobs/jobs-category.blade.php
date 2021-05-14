@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h3>{{ $categoryName->name }} category jobs:</h3>
        <table class="table">
            <thead>
                <th>Logo</th>
                <th>Position:</th>
                <th>Address:</th>
                <th>Date:</th>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                    <td>
                        <img src="{{ asset('uploads/logo') }}/{{ $job->company->logo }}" width="80">
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
                        <a href="{{ route('jobs.show', [$job->id, $job->slug]) }}">
                        <button class="btn btn-success btn-sm">Apply</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            <div class="justify-content-center">
            {{ $jobs->appends(Request::except('page'))->links() }}
            </div>
    </div>
</div>

</div>


@endsection
