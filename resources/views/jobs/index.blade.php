@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <search-component></search-component>
        <h1>Recent jobs</h1>
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
                        {{ $job->type }}
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

    </div>

    <div>
        <a href="{{ route('jobs.all') }}"><button class="btn btn-success btn-lg" style="width: 100%;">Browse all jobs</button></a>
    </div>
    <br>
    <h1>Featured companies</h1>

</div>

<div class="container">
    <div class="row">
        @foreach ($companies as $company)
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('uploads/logo') }}/{{ $company->logo }}" width="100" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{ $company->company_name }}</h5>
                    <p class="card-text">{{ str_limit($company->description, 50) }}</p>
                    <a href="{{ route('company.show', [$company->id, $company->slug]) }}" class="btn btn-primary">Visit company page</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
