@extends('layouts.main')
@section('content')
   <div class="album text-muted">
     <div class="container">
      @if(Session::has('message'))

      <div class="alert alert-success">{{Session::get('message')}}</div>
      @endif
        @if(Session::has('err_message'))

      <div class="alert alert-danger">{{Session::get('err_message')}}</div>
      @endif
      @if(isset($errors)&&count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>

      @endif

       <div class="row" id="app">
          <div class="title" style="margin-top: 20px;">
                <h2>{{$job->title}}</h2>

          </div>

      <img src="{{asset('hero-job-image.jpg')}}" style="width: 100%; border-radius: 5px;">

          <div class="col-lg-8">


            <div class="p-4 mb-8 bg-white">
              <!-- icon-book mr-3-->
              <h3 class="h5 text-black mb-3">Description <a href="#"data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-envelope-square" style="font-size: 25px;float:right;color:green;"> Share job</i></a></h3>
              <p> {{$job->description}}.</p>

            </div>
            <div class="p-4 mb-8 bg-white">
              <!--icon-align-left mr-3-->
              <h3 class="h5 text-black mb-3">Roles and Responsibilities</h3>
              <p>{{$job->roles}} .</p>

            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3">Number of vacancy</h3>
              <p>{{$job->number_of_vacancy }} </p>

            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3">Experience</h3>
              <p>{{$job->experience}}&nbsp;years</p>

            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3">Gender</h3>
              <p>{{$job->gender}} </p>

            </div>
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3">Salary</h3>
              <p>{{$job->salary}}</p>
            </div>

          </div>


            <div class="col-md-4 p-4 site-section bg-light">
              <h3 class="h5 text-black mb-3 text-center"><b>Short Info</b></h3>
                  <p><b>Company name: </b>{{$job->company->company_name}}</p>
                <p><b>Address: </b>{{$job->address}}</p>
                    <p><b>Employment Type: </b>{{$job->type}}</p>
                    <p><b>Position: </b>{{$job->position}}</p>
                    <p><b>Posted: </b>{{$job->created_at->diffForHumans()}}</p>
                    <p><b>Last date to apply: </b>{{ date('F d, Y', strtotime($job->last_date)) }}</p>



              <p><a href="{{route('company.index',[$job->company->id,$job->company->slug])}}" class="btn btn-warning" style="width: 100%;">Visit Company Page</a></p>
              <p>
                @if(Auth::check()&&Auth::user()->user_type=='seeker')
                @if(!$job->checkApplication())
                    <apply-component :jobid={{ $job->id }}></apply-component>
                @endif
                <br>
                <favourite-component :jobid={{ $job->id }} :favourited={{ $job->checkSaved()?'true':'false' }}></favourite-component>
                @endif

              </p>

            </div>
        </div>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Related jobs</div>
            <div class="card-body">
                <div class="row">
                @foreach($jobRecommendations as $jobRecommendation)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p class="badge badge-success">{{$jobRecommendation->type}}</p>
                            <h5 class="card-title">{{$jobRecommendation->position}}</h5>
                            <p class="card-text">{{str_limit($jobRecommendation->description,90)}}
                            <center> <a href="{{route('jobs.show',[$jobRecommendation->id,$jobRecommendation->slug])}}" class="btn btn-success">Apply</a></center>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>


</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send this job to your friend</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('mail') }}" method="POST">@csrf

      <div class="modal-body">
        <input type="hidden" name="job_id" value="{{$job->id}}">
        <input type="hidden" name="job_slug" value="{{$job->slug}}">

        <div class="form-goup">
          <label>Your name:</label>
          <input type="text" name="your_name" class="form-control" required="">
        </div>
        <div class="form-goup">
          <label>Your email:</label>
          <input type="email" name="your_email" class="form-control" required="">
        </div>
        <div class="form-goup">
          <label>Friend name:</label>
          <input type="text" name="friend_name" class="form-control" required="">
        </div>
        <div class="form-goup">
          <label>Friend email:</label>
          <input type="email" name="friend_email" class="form-control" required="">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Mail this job</button>
      </div>
    </form>
    </div>
  </div>
</div>



<br>
<br>
<br>

     </div>
   </div>
@endsection



{{--
<h3>Related jobs:</h3> <br>
@foreach($jobRecommendations as $jobRecommendation)
<div class="col-md-3">
<div class="card" style="width: 18rem;">
<div class="card-header">{{ __('My saved jobs') }}</div>
<div class="card-body">
<p class="badge badge-success">{{$jobRecommendation->type}}</p>
<h5 class="card-title">{{$jobRecommendation->position}}</h5>
<p class="card-text">{{str_limit($jobRecommendation->description,90)}}
<center> <a href="{{route('jobs.show',[$jobRecommendation->id,$jobRecommendation->slug])}}" class="btn btn-success">Apply</a></center>
</div>
</div>
</div>
@endforeach
 --}}
