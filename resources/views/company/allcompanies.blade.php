@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Companies:</h2>
    <div class="row">
        @foreach ($companies as $company)

        <div class="col-md-4">
            <div class="card testimonial-card mt-2 mb-3">
                <a href="{{ route('company.index',[$company->id, $company->slug]) }}">
                <div class="card-up aqua-gradient"></div>
                <div class="avatar mx-auto white">
                    @if(empty($company->logo))
                        <img src="{{ asset('uploads/logo/avatar.jpg') }}" width="80" class="card img-top">
                    @else
                    <img src="{{ asset('uploads/logo') }}/{{$company->logo }}"
                        class="rounded-circle img-fluid" alt="woman avatar">
                    @endif
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title font-weight-bold">{{ $company->company_name }}</h4>
                    <hr>
                    <p><i class="fas fa-quote-left"></i>{{ $company->slogan }}<i class="fas fa-quote-right"></i></p>
                </div>
            </div>
        </a>
        </div>
        @endforeach
        {{$companies->links()}}
    </div>
</div>
@endsection

<style>
    body {
        background-color: #f5f7fa;
    }

    .testimonial-card .card-up {
        height: 120px;
        overflow: hidden;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }

    .aqua-gradient {
        background: linear-gradient(40deg, #2096ff, #05ffa3) !important;
    }

    .testimonial-card .avatar {
        width: 120px;
        margin-top: -60px;
        overflow: hidden;
        border: 5px solid #fff;
        border-radius: 50%;
    }

</style>
{{--
<div class="col-md-3">
    <div class="card mb-3 mx-2 my-4" style="width: 18rem;">
@if(empty($company->logo))
            <img src="{{ asset('uploads/logo/avatar.jpg') }}" width="286" height="180"
class="card img-top">
@else
<img src="{{ asset('uploads/logo') }}/{{ $company->logo }}" width="286" height="180"
    class="card img-top">
@endif
<div class="card-body">
    <h5 class="card-title text-center">{{ $company->company_name }}</h5>
    <center><a href="{{ route('company.index',[$company->id, $company->slug]) }}"
            class="btn btn-primary">View company</a></center>
</div>
</div>
</div> --}}
