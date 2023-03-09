@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Task') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('tasks.store') }}" method="post">
                            @csrf
                            <div class="mt-3">
                                <label for="">Task Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">Task Description</label>
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
                                <select class="form-select" name="assigned_to_id">
                                    <option selected>Assign To User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-add"></i></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
