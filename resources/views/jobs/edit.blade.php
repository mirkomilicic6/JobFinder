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
                <div class="card-header"><b>Edit job</b></div>
                <div class="card-body">
            {{-- form --}}
            <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                @csrf
           <div class="form-group">
               <label for="title">Title:</label>
               <input type="text" name="title" class="form-control" value="{{ $job->title }}">
                    @if($errors->has('title'))
                    <div class="error" style="color: red;">{{ $errors->first('title') }}</div>
                    @endif
           </div>
           <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control">{{ $job->description }}</textarea>
            @if($errors->has('description'))
            <div class="error" style="color: red;">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="roles">Roles:</label>
            <textarea name="roles" class="form-control">{{ $job->roles }}</textarea>
            @if($errors->has('roles'))
            <div class="error" style="color: red;">{{ $errors->first('roles') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control" id="">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{$category->id==$job->category_id?'selected':'s'}}>{{ $category->name }}</option>
                @endforeach
            </select>
            @if($errors->has('category_id'))
                    <div class="error" style="color: red;">{{ $errors->first('category_id') }}</div>
                    @endif
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" name="position" class="form-control" value="{{ $job->position }}">
            @if($errors->has('position'))
            <div class="error" style="color: red;">{{ $errors->first('position') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" class="form-control" value="{{ $job->address }}">
            @if($errors->has('address'))
            <div class="error" style="color: red;">{{ $errors->first('address') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="number_of_vacancy">Number of vacancy:</label>
            <input type="text" name="number_of_vacancy" class="form-control" value={{ $job->number_of_vacancy }}>
            @if($errors->has('number_of_vacancy'))
            <div class="error" style="color: red;">{{ $errors->first('number_of_vacancy') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="experience">Years of experience:</label>
            <input type="text" name="experience" class="form-control" value="{{ $job->experience }}">
            @if($errors->has('experience'))
            <div class="error" style="color: red;">{{ $errors->first('experience') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" class="form-control">
                <option value="any"{{$job->gender=='any'?'selected':''}}>Any</option>
                <option value="male"{{$job->gender=='male'?'selected':''}}>Male</option>
                <option value="female"{{$job->gender=='female'?'selected':''}}>Female</option>
            </select>
            @if($errors->has('gender'))
            <div class="error" style="color: red;">{{ $errors->first('gender') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" class="form-control">
                <option value="fulltime"{{$job->type=='fulltime'?'selected':''}}>Fulltime</option>
                <option value="parttime"{{$job->type=='parttime'?'selected':''}}>Part time</option>
                <option value="casual"{{$job->type=='casual'?'selected':''}}>Casual</option>
            </select>
            @if($errors->has('type'))
            <div class="error" style="color: red;">{{ $errors->first('type') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="salaray">Salary:</label>
            <select name="salary" class="form-control">
                <option value="negotiable"{{$job->salaray=='negotiable'?'selected':''}}>Negotiable</option>
                <option value="2000-5000"{{$job->salaray=='2000-5000'?'selected':''}}>2000-5000</option>
                <option value="5000-10000"{{$job->salaray=='5000-10000'?'selected':''}}>5000-10000</option>
                <option value="10000-20000"{{$job->salaray=='10000-20000'?'selected':''}}>10000-20000</option>
                <option value="30000-50000"{{$job->salaray=='30000-50000'?'selected':''}}>30000-50000</option>
            </select>
            @if($errors->has('salary'))
            <div class="error" style="color: red;">{{ $errors->first('salary') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="1"{{$job->status=='1'?'selected':''}}>Live</option>
                <option value="0"{{$job->status=='0'?'selected':''}}>Draft</option>
            </select>
            @if($errors->has('status'))
            <div class="error" style="color: red;">{{ $errors->first('status') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="last_date">Last date::</label>
            <input type="text" id="datepicker" name="last_date" class="form-control" value="{{ $job->last_date }}">
            @if($errors->has('last_date'))
                    <div class="error" style="color: red;">{{ $errors->first('last_date') }}</div>
                    @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Update</button>
        </div>


        </div>
    </form>
    </div>
</div>

    </div>
</div>
@endsection
