@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                <label for="">Category&nbsp;</label>
                <select name="category_id" class="form-control" id="">
                        <option value="">-- select --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>&nbsp;
            </div>
            <div class="form-group">
                <label for="">Address &nbsp;</label>
                <input type="text" name="address" class="form-control">&nbsp;
            </div>
            <div class="form-group">
                <button class="btn btn-outline-success">Search</button>
            </div>
        </div>
    </form>

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
        {{-- {{ $jobs->appends(Request::except('page'))->links() }} --}}
    </div>


</div>


@endsection
