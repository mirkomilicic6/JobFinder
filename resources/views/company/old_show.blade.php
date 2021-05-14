@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(empty($company->cover_photo))
            <img src="{{ asset('uploads/coverphoto/cover.jpg') }}" class="card img-top">
            @else
                <img src="{{ asset('uploads/coverphoto') }}/{{ $company->cover_photo }}" width="100%" height="400" alt="" srcset="">
            @endif
        </div>
    </div>
<div class="row">
        <div class="card-body">
            @if(empty($company->logo))
                <img src="{{ asset('uploads/logo/avatar.jpg') }}" width="80" class="card img-top">
            @else
                <img src="{{ asset('uploads/logo') }}/{{ $company->logo }}" width="80">
            @endif
          <h5 class="card-title">{{ $company->company_name }}</h5>
          <p class="card-text">{{ $company->description }}</p>
          <p class="card-text"><small class="text-muted">{{ $company->slogan }}</small></p>
        </div>
</div>
<hr>
<div class="row">
    <h3>More jobs from this company:</h3>
</div>
<div class="row">
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
