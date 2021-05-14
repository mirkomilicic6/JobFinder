@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create new job category</h1>
@stop

@section('content')
<div class="container">
    {{-- form start --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Create new job category</b></div>

                <form action="{{ route('backendCategory.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="">Category name</label>
                        <input type="text" class="form-control" name="name">
                        @if($errors->has('name'))
                            <div class="error" style="color: red;">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Create category</button>
                    </div>
                </div>
            </div>

            @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @endif
        </form>
        </div>
    </div>
</div>
    {{-- form end --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

