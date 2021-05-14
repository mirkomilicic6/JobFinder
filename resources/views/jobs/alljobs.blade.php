@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
<form action="{{ route('jobs.all') }}" method="GET">
        <div class="form-inline">
            <div class="form-group">
                <label for="">Keyword &nbsp;</label>
                <input type="text" name="title" class="form-control">&nbsp;
            </div>
            <div class="form-group">
                <label for="">Employment type &nbsp;</label>
                <select name="type" class="form-control">
                    <option value="">-- select --</option>
                    <option value="fulltime">Fulltime</option>
                    <option value="parttime">Part time</option>
                    <option value="casual">Casual</option>
                </select>&nbsp;
            </div>
            <div class="form-group">
                <label for="">Category &nbsp;</label>
                <select name="category_id" class="form-control" id="">
                        <option value="">-- select --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>&nbsp;
            </div>

            <div class="form-group">
                <button class="btn btn-outline-success">Search</button>
            </div>
        </div>
    </form>

    <div class="rounded border jobs-wrap mt-3">
        @if(count($jobs) > 0)
        @foreach ($jobs as $job)

          <a href="{{ route('jobs.show', [$job->id, $job->slug]) }}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
            <div class="company-logo blank-logo text-center text-md-left pl-3">
                @if(empty($job->company->logo))
                        <img src="{{ asset('uploads/logo/avatar.jpg') }}" width="80" class="card img-top">
                @else
              <img src="{{ asset('uploads/logo') }}/{{ $job->company->logo }}" alt="Image" class="img-fluid mx-auto">
              @endif
            </div>
            <div class="job-details h-100">
              <div class="p-3 align-self-center">
                <h3>{{ $job->position }}</h3>
                <div class="d-block d-lg-flex">
                  <div class="mr-3"><span class="icon-suitcase mr-1"></span>{{ $job->company->company_name }}</div>
                  <div class="mr-3"><span class="icon-room mr-1"></span> {{ str_limit($job->address,20) }}</div>
                  <div><span class="icon-money mr-1"></span>{{ $job->salary }}$</div>
                  <div>&nbsp;&nbsp;&nbsp;<span class="icon-clock-o mr-1"></span>{{ $job->created_at->diffForHumans() }}</div>
                </div>
              </div>
            </div>
            <div class="job-category align-self-center">

            @if($job->type=='fulltime')
              <div class="p-3">
                <span class="text-info p-2 rounded border border-info">{{ $job->type }}</span>
              </div>

            @elseif($job->type=='parttime')
              <div class="p-3">
                <span class="text-warning p-2 rounded border border-warning">{{ $job->type }}</span>
              </div>

            @else
                <div class="p-3">
                <span class="text-danger p-2 rounded border border-danger">{{ $job->type }}</span>
              </div>
            @endif
            </div>
          </a>
        @endforeach
          @else
          No jobs found.
          @endif
        </div>            <div class="justify-content-center">
            {{ $jobs->appends(Request::except('page'))->links() }}
            </div>
    </div>
</div>

</div>
<br>
<br>
<br>

@endsection
