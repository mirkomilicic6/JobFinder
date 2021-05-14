@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($applicants as $applicant)
            <div class="card mb-4">
                <div class="card-header"><p><a href="{{ route('jobs.show', [$applicant->id, $applicant->slug]) }}"><b>Job:</b> {{ $applicant->title }}</a></p></div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <th scope="col">Applied at</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email:</th>
                            <th scope="col">Address</th>
                            <th scope="col">Experience:</th>
                            <th scope="col">Resume:</th>
                            <th scope="col">Cover letter:</th>
                        </thead>
                        <tbody>
                            @foreach ($applicant->users as $user)
                            <tr>
                                <td>
                                    {{$user->pivot->created_at}}
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                     {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->profile->address }}
                                </td>

                                <td>
                                    {{ $user->profile->experience }}

                                </td>
                                <td>
                                    <a href="{{ Storage::url($user->profile->resume) }}">
                                    <button class="btn btn-success btn-sm">Resume</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ Storage::url($user->profile->cover_letter) }}">
                                    <button class="btn btn-success btn-sm">Cover letter</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>





       {{--  <p><a href="{{ route('jobs.show', [$applicant->id, $applicant->slug]) }}"><b>Job:</b> {{ $applicant->title }}</a></p>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Biography</th>
                <th scope="col">Handle</th>
                <th scope="col">Experience</th>
                <th scope="col">Resume</th>
                <th scope="col">Cover letter</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($applicant->users as $user)
                <tr>
                    <th scope="row">{{ $user->na{{ $user->profile->experience }}me }}</th>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->profile->address }}</td>
                    <td>{{ $user->profile->bio }}</td>
                    <td></td>
                    <td><a href="{{ Storage::url($user->profile->resume) }}">Resume</td>
                    <td><a href="{{ Storage::url($user->profile->cover_letter) }}">Cover letter</td>
                  </tr>
                @endforeach

            </tbody>
          </table>
          <hr>
        @endforeach --}}
    </div>
</div>
@endsection


<{{-- div class="col-md-12">
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
