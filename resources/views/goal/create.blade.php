@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Goal') }}</div>

                    <div class="card-body">
                        <form action="{{ route('goals.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Goal Title</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Goal Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Timeframe Start Date</label>
                                    <input type="date" name="timeframe_start_date" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="">Timeframe End Date</label>
                                    <input type="date" name="timeframe_end_date" class="form-control">
                                </div>
                            </div>
                            <div class="mt-3">
                                <select class="form-select" name="department_id">
                                    <option selected value="">Assign To Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="type"
                                        id="type" checked>
                                    <label class="form-check-label" for="type">
                                        Add To Favorite
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Add Goal</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
