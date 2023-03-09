@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Plan') }}</div>

                    <div class="card-body">
                        <form action="/plans/{{ $plan->id }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $plan->id }}" class="form-control">
                            <div class="mt-3">
                                <label for="">Plan Name</label>
                                <input type="text" name="name" value="{{ $plan->name }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">Plan Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"> {{ $plan->description }} </textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Timeframe Start Date</label>
                                    <input type="date" name="timeframe_start_date"
                                        value="{{ $plan->timeframe_start_date }}" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="">Timeframe End Date</label>
                                    <input type="date" name="timeframe_end_date" value="{{ $plan->timeframe_end_date }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mt-3">
                                <select class="form-select" name="goal_id">
                                    <option selected value="">Parent Goal</option>
                                    @foreach ($goals as $goal)
                                        <option value="{{ $goal->id }}" {{ $plan->goal_id == $goal->id ?'selected' :'' }}>{{ $goal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <select class="form-select" name="assigned_to_id">
                                    <option selected value="">Assign To User(Team-leader)</option>
                                    @foreach ($team_leaders as $team_leader)
                                        <option value="{{ $team_leader->id }}" {{ $plan->assigned_to_id == $team_leader->id ?'selected' :'' }}>{{ $team_leader->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="type" id="type" checked>
                                    <label class="form-check-label" for="type">
                                        Add To Favorite
                                    </label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="complete" id="complete">
                                    <label class="form-check-label" for="complete">
                                        Mark As Complete
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Edit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
