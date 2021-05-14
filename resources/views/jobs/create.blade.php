@extends('layouts.main')

@section('content')
<div class="container">
    @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a job</div>
                <div class="card-body">
            {{-- form --}}
            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf
           <div class="form-group">
               <label for="title">Title:</label>
               <input type="text" name="title" class="form-control">
                    @if($errors->has('title'))
                    <div class="error" style="color: red;">{{ $errors->first('title') }}</div>
                    @endif
           </div>
           <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control"></textarea>
            @if($errors->has('description'))
            <div class="error" style="color: red;">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="roles">Roles:</label>
            <textarea name="roles" class="form-control"></textarea>
            @if($errors->has('roles'))
            <div class="error" style="color: red;">{{ $errors->first('roles') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control" id="">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @if($errors->has('category_id'))
                    <div class="error" style="color: red;">{{ $errors->first('category_id') }}</div>
                    @endif
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" name="position" class="form-control">
            @if($errors->has('position'))
            <div class="error" style="color: red;">{{ $errors->first('position') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" class="form-control">
            @if($errors->has('address'))
            <div class="error" style="color: red;">{{ $errors->first('address') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="number_of_vacancy">Number of vacancy:</label>
            <input type="text" name="number_of_vacancy" class="form-control">
            @if($errors->has('number_of_vacancy'))
            <div class="error" style="color: red;">{{ $errors->first('number_of_vacancy') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="experience">Years of experience:</label>
            <input type="text" name="experience" class="form-control">
            @if($errors->has('experience'))
            <div class="error" style="color: red;">{{ $errors->first('experience') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" class="form-control">
                <option value="any">Any</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @if($errors->has('gender'))
            <div class="error" style="color: red;">{{ $errors->first('gender') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" class="form-control">
                <option value="fulltime">Fulltime</option>
                <option value="parttime">Part time</option>
                <option value="casual">Casual</option>
            </select>
            @if($errors->has('type'))
            <div class="error" style="color: red;">{{ $errors->first('type') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <select name="salary" class="form-control">
                <option value="negotiable">Negotiable</option>
                <option value="2000-5000">2000-5000</option>
                <option value="5000-10000">5000-10000</option>
                <option value="10000-20000">10000-20000</option>
                <option value="30000-50000">30000-50000</option>
            </select>
            @if($errors->has('salary'))
            <div class="error" style="color: red;">{{ $errors->first('salary') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="1">Live</option>
                <option value="0">Draft</option>
            </select>
            @if($errors->has('status'))
            <div class="error" style="color: red;">{{ $errors->first('status') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="last_date">Last date::</label>
            <input type="text" id="datepicker" name="last_date" class="form-control">
            @if($errors->has('last_date'))
                    <div class="error" style="color: red;">{{ $errors->first('last_date') }}</div>
                    @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
        </div>
    </form>
    </div>
</div>

    </div>
</div>
@endsection
