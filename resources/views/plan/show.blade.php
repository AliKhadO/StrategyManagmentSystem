@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form disabled>
                    <div class="card">
                        <div class="card-header">{{ __('Plan Details') }}</div>
                        <div class="card-body">
                            <div class="mt-3">
                                <label for="">Plan Name
                                    @if ($plan->type)
                                        <a href="plans/{{ $plan->id }}/favorite">
                                            <span class="fav">☆</span>
                                        </a>
                                    @else
                                        <a href="plans/{{ $plan->id }}/favorite">
                                            <span class="fav">★</span>
                                        </a>
                                    @endif

                                </label>
                                <input type="text" name="name" value="{{ $plan->name }}" class="form-control" disabled readonly>
                            </div>
                            <div class="mt-3">
                                <label for="">Plan Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" disabled readonly> {{ $plan->description }} </textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="">Timeframe Start Date</label>
                                    <input type="date" name="timeframe_start_date"
                                        value="{{ $plan->timeframe_start_date }}" disabled readonly class="form-control">
                                </div>
                                <div class="col">
                                    <label for="">Timeframe End Date</label>
                                    <input type="date" name="timeframe_end_date" disabled readonly value="{{ $plan->timeframe_end_date }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mt-3">
                                <h4>Parent Goal</h4>
                                <select class="form-select" name="goal_id" readonly disabled>
                                    <option selected value="">Parent Goal</option>
                                    @foreach ($goals as $goal)
                                        <option value="{{ $goal->id }}" {{ $plan->goal_id == $goal->id ?'selected' :'' }}>{{ $goal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <h4>Assigned To User(Team-leader)</h4>
                                <select class="form-select" name="assigned_to_id" readonly disabled>
                                    <option selected value="">Assign To User(Team-leader)</option>
                                    @foreach ($team_leaders as $team_leader)
                                        <option value="{{ $team_leader->id }}" {{ $plan->assigned_to_id == $team_leader->id ?'selected' :'' }}>{{ $team_leader->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
