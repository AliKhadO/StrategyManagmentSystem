@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Department') }}</div>

                    <div class="card-body">
                        <form action="{{ route('departments.update' , $department->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $department->id }}" name="id">
                            <div class="form-group">
                                <label for="">Department Title</label>
                                <input type="text" name="name" class="form-control" value="{{ $department->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Department Location</label>
                                <input type="text" name="location" class="form-control" value="{{ $department->location }}">
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Update Department</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
