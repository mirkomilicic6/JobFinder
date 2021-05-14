@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($applications as $application)
            <div class="card mb-4">
                <div class="card-header"><p><a href="{{ route('jobs.show', [$application->id, $application->slug]) }}"><b>Job:</b> {{ $application->title }}</a></p></div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Applied at</th>
                            <th scope="col">Position</th>
                            <th scope="col">Job address</th>
                            <th scope="col">Company name</th>
                            <th scope="col">Employment type</th>

                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$application->pivot->created_at}}</td>
                                <td>{{ $application->position }}</td>
                                <td>{{ $application->address }}</td>
                                <td>{{ $application->company->company_name }}</td>
                                <td>{{ $application->type }}</td>
                              </tr>
                        </tbody>
                      </table>
                </div>
            </div>
            @endforeach
        </div>


    </div>
</div>
@endsection
{{-- end

{{-- <div class="col-md-12">
    <div class="card">
        @foreach ($applicants as $applicant)


        <div class="card-header"><a href="{{ route('jobs.show', [$applicant->id, $applicant->slug]) }}"><b>Job:</b> {{ $applicant->title }}</a></div>

        <div class="card-body">
            @foreach ($applicant->users as $user)


            <table class="table table-striped">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                   </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->profile->address }}</td>
                    <td>{{ $user->profile->bio }}</td>
                    <td>{{ $user->profile->experience }}</td>
                    <td><a href="{{ Storage::url($user->profile->resume) }}">Resume</td>
                    <td><a href="{{ Storage::url($user->profile->cover_letter) }}">Cover letter</td>
                  </tr>

                </tbody>
              </table>


        </div>
        @endforeach
        @endforeach
    </div>
</div> --}}
