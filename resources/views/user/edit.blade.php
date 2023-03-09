@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update My Account') }}</div>
                    <div class="card-body">
                        <form action="/user/{{ $user->id }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $user->id }}" class="form-control">
                            <div class="mt-3">
                                <label for="">Firstname</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">Lastname</label>
                                <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="">Phone Number</label>
                                <input type="phone" name="phone_number" value="{{ $user->phone_number }}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Update My Account</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
