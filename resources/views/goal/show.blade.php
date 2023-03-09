@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('View Goal') }}</div>

                    <div class="card-body">
                        <form disabled>
                            <input type="hidden" value="{{ $goal->id }}" name="id" disabled readonly>
                            <div class="form-group">
                                <label for="">Goal Title
                                    @if ($goal->type)
                                        <a href="plans/{{ $goal->id }}/favorite">
                                            <span class="fav">☆</span>
                                        </a>
                                    @else
                                        <a href="plans/{{ $goal->id }}/favorite">
                                            <span class="fav">★</span>
                                        </a>
                                    @endif
                                </label>
                                <input type="text" name="name" class="form-control" value="{{ $goal->name }}" disabled
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label for="">Goal Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                    disabled readonly>{{ $goal->description }}</textarea>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Timeframe Start Date</label>
                                    <input type="date" name="timeframe_start_date" class="form-control"
                                        value="{{ $goal->timeframe_start_date }}" disabled readonly>
                                </div>
                                <div class="col">
                                    <label for="">Timeframe End Date</label>
                                    <input type="date" name="timeframe_end_date" class="form-control"
                                        value="{{ $goal->timeframe_end_date }}" disabled readonly>
                                </div>
                            </div>
                            <div class="mt-3">
                                <select class="form-select" name="department_id" value="{{ $goal->department_id }}"
                                    disabled readonly>
                                    <option selected value="">Assigned To Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $goal->department_id == $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
