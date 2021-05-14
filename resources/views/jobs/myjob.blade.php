@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">{{ __('My saved jobs') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <th scope="col">Logo</th>
                            <th scope="col">Position:</th>
                            <th scope="col">Job type</th>
                            <th scope="col">Address:</th>
                            <th scope="col">Date:</th>
                            <th scope="col">Actions:</th>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr>
                                <td>
                                    @if(empty(Auth::user()->company->logo))
                                    <img src="{{ asset('uploads/avatar/avatar.jpg') }}" height="50" width="50">
                                    @else
                                    <img src="{{ asset('uploads/logo') }}/{{ Auth::user()->company->logo }}" style="width: 20%;">
                                    @endif
                                </td>
                                <td>
                                     {{ $job->position }}
                                </td>
                                <td>
                                    <i class="fas fa-clock"></i>{{ $job->type }}
                                </td>
                                <td><i class="fas fa-map-marker-alt"></i>
                                     {{ $job->address }}
                                </td>
                                <td><i class="fas fa-calendar-week"></i>
                                     {{ $job->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('jobs.show', [$job->id, $job->slug]) }}">
                                    <button class="btn btn-success btn-sm">Read</button>
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
