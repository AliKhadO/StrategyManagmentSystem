@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center rounded-circle shadow"
            style="aspect-ratio : 1 / 1; height:100px;width:100px">
            <h4 class="m-0"> {{ getInitials(Auth::user()->name) }}</h4>
        </div>
        <div class="">
            Good
            @if (date('H') < 12)
                Morning
            @elseif(date('H') < 17)
                Afternoon
            @elseif(date('H') < 20)
                Evening
            @else
                Night
            @endif
            ,
            {{ Auth::user()->name }}
        </div>
        <div class="">
            Here’s what is happening in StrategyGo today.
        </div>
    </div>
    <hr>
    <div class="row equal-cols g-3">
        <div class="col-md-8 align-items-stretch">
            <div class="shadow rounded p-3">
                <h5>Quick actions</h5>
                <div class="d-flex justify-content-around align-items-center">
                    <a href="{{ route('plans.create') }}">

                        <div
                            class="bg-success rounded p-4 d-flex justify-content-center align-items-center">
                            <i class="fa fa-pencil text-bold text-white"></i>
                            &nbsp;
                            <div class="text-white">Add Plan </div>
                        </div>
                    </a>
                    <a href="{{ route('goals.create') }}">

                        <div
                            class="bg-success rounded p-4 d-flex justify-content-center align-items-center">
                            <i class="fa fa-bullseye text-bold text-white">

                            </i>&nbsp;
                            <div class="text-white">Add Goal </div>
                        </div>
                    </a>
                    <a href="{{ route('tasks.create') }}">

                        <div
                            class="bg-success rounded p-4 d-flex justify-content-center align-items-center">
                            <i class="fas fa-tasks text-bold text-white"></i>
                            &nbsp;
                            <div class="text-white">Add Task </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 align-items-stretch" style="max-height: 30vh;overflow:auto">
            <div class="shadow rounded p-3">
                <h5>Last Notifications</h5>
                <table class="table table-striped table-sm" style="font-size: .8rem">
                    <thead>
                        <tr>
                            <th>
                                Goal Name
                            </th>
                            <th>
                                Timeframe End Date
                            </th>
                            <th>/</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $notification)
                            <tr>
                                <td>{{ $notification->name }}</td>
                                <td>{{ $notification->timeframe_end_date }}</td>
                                <td><a href="{{ route('goals.show' , $notification->id) }}" class="text-success text-decoration-underline">Go To Details</a></td>
                            </tr>
                        @empty
                            <h4>No Notifications to Show</h4>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>
        <div class="col-md-8 align-items-stretch">
            <div class="d-flex flex-column bg-white shadow rounded p-3" style="max-height: 45vh ; overflow:auto">
                @forelse ($my_goals as $goal)
                    <div class="row mt-3">
                        <div
                            class="col-md-1 bg-success bg-gradient d-flex justify-content-center align-items-center py-4 rounded-start">
                            <i class="fa fa-cog text-white"></i>
                        </div>
                        <div class="col bg-light rounded-end">
                            <small>
                                <a class="text-success text-decoration-underline"
                                    href="{{ route('goals.show', $goal) }}">{{ $goal->name }}</a>
                            </small>
                            <div class='d-flex flex-column'>
                                <div class="d-flex justify-content-between opacity-25">
                                    <small>0%</small>
                                    <small>Completed</small>
                                    <small>100%</small>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $goal->complete_plans_percent() }}%"
                                        aria-valuenow="{{ $goal->complete_plans()->count() }}" aria-valuemin="0"
                                        aria-valuemax="{{ $goal->plans()->count() }}">
                                        {{ $goal->complete_plans_percent() }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                @endforelse
            </div>

        </div>
        <div class="col-md-4 align-items-stretch">
            <div class="shadow rounded p-3">
                <h5>My Favorite</h5>
                <p>With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-link text-decoration-none text-primary">View Plans</a>
            </div>
        </div>
    </div>
@endsection
