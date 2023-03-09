@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Goal') }}</div>

                    <div class="card-body">
                        <form action="{{ route('goals.update', $goal->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $goal->id }}" name="id">
                            <div class="form-group">
                                <label for="">Goal Title</label>
                                <input type="text" name="name" class="form-control" value="{{ $goal->name }}">
                            </div>

                            <div class="form-group">
                                <label for="">Goal Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $goal->description }}</textarea>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Timeframe Start Date</label>
                                    <input type="date" name="timeframe_start_date" class="form-control"
                                        value="{{ $goal->timeframe_start_date }}">
                                </div>
                                <div class="col">
                                    <label for="">Timeframe End Date</label>
                                    <input type="date" name="timeframe_end_date" class="form-control"
                                        value="{{ $goal->timeframe_end_date }}">
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
                                    <input class="form-check-input" type="checkbox" name="complete" id="complete">
                                    <label class="form-check-label" for="complete">
                                        Mark As Complete
                                    </label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="type"
                                        id="type" checked>
                                    <label class="form-check-label" for="type">
                                        Add To Favorite
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Update Goal</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
