@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit User') }}</div>

                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mt-3">
                                <label for="">User Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">User Last Name</label>
                                <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">User Email</label>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <span class="fw-bold">Role: (current :{{ $user->roles->first()->name}})</span>
                                <select class="form-select" name="role">
                                    <option value="specialist">Specialist</option>
                                    <option value="admin">Admin</option>
                                    <option value="team_leader">Team Leader</option>
                                    <option value="manager">Manager</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Save</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
