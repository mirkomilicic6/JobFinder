@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
    <div class="row" id="app">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $job->title }}</div>
                    <div class="card-body">
                        <p>
                        <h3>Description</h3>
                        {{ $job->description }}
                        </p>

                        <p>
                            <h3>Duties</h3>
                        {{ $job->roles }}
                        </p>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Job info</div>

                <div class="card-body">
                    <p><b>Company:</b><a href="{{ route('company.show', [$job->company->id, $job->company->slug]) }}"> {{ $job->company->company_name }}</a></p>
                    <p><b>Address:</b> {{ $job->address }}</p>
                    <p><b>Employment type:</b> {{ $job->type }}</p>
                    <p><b>Position:</b> {{ $job->position }}</p>
                    <p><b>Date:</b> {{ $job->created_at->diffForHumans() }}</p>
                    <p><b>Applications deadline date:</b> {{ date('F d, Y', strtotime($job->last_date)) }} </p>
                </div>
            </div>

            @if(Auth::check()&&Auth::user()->user_type=='seeker')
            @if(!$job->checkApplication())
                <apply-component :jobid={{ $job->id }}></apply-component>
            @endif
            <br>
            <favourite-component :jobid={{ $job->id }} :favourited={{ $job->checkSaved()?'true':'false' }}></favourite-component>
            @endif
        </div>

    </div>
</div>
@endsection
