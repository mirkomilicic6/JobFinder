@extends('layouts.main')

@section('content')
<div class="container">
<div class="col-md-12">
        <div class="company-profile">
            <img src="{{ asset('cover/cover.jpg') }}" style= width: 100%;>
            <div class="company-desc">

                <img src="{{ asset('avatar/avatar.jpg') }}" width=100>
                <p>{{ $company->description }}</p>
                <h1>{{ $company->company_name }}</h1>
                <p><b>Slogan:</b> {{ $company->slogan }}</p>
                <p><b>Address:</b> {{ $company->address }}</p>
                <p><b>Phone:</b> {{ $company->phone }}</p>
                <p><b>Website:</b> {{ $company->website }}</p>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>Logo</th>
                <th>Position:</th>
                <th>Address:</th>
                <th>Date:</th>
            </thead>
            <tbody>
                @foreach ($company->jobs as $job)
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
                        <a href="{{ route('jobs.show', [$job->id, $job->slug]) }}">
                        <button class="btn btn-success btn-sm">Apply</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
</div>
@endsection
