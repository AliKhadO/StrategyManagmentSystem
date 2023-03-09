@extends('layouts.layout')
@section('content')
    <div class="d-flex justify-content-around alig-items-center align-self-stretch">
        <div class="w-100 me-2">
            <h4>Departments:</h4>
            <ul class="list-group mt-3">
                @forelse ($departments as $department)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $department->name }}</div>
                            {{ $department->location }}
                        </div>
                        <div>
                            @can('edit tasks')
                                <a href="departments/{{ $department->id }}/edit" class="btn" role="button"><i
                                        class="fa fa-pen text-primary"></i></a>|
                            @endcan
                            @can('delete tasks')
                                <form action="departments/{{ $department->id }}" method="post" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn with-confirm" type="submit"><i
                                            class="fa fa-trash text-danger"></i></button>
                                </form>
                            @endcan
                        </div>
                    </li>
                @empty
                    <li>No Data</li>
                @endforelse
            </ul>
            <a class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#departmentModal">Add Department</a>
        </div>
        <div class="border"></div>
        <div class="w-100 ms-2">
            <h4>Assign Users To Departments:</h4>
            <ul class="list-group mt-3 ">
                @forelse ($users as $user)
                    <li class="list-group-item d-flex flex-column justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $user->name }}&nbsp;{{ $user->last_name }}</div>
                        </div>
                        <div class="ms-2">
                            <span class="fw-bold">Department: </span>
                            <select class="form-select department_select" data-user-id="{{ $user->id }}">
                                <option value="">Assign To Department</option>
                                @foreach ($departments as $dept)
                                    @if ($dept->id == $user->department_id)
                                        <option selected value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @else
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </li>
                @empty
                    <li>No Data</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('settings.store_department') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="mt-3">
                            <label for="">Department Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="">Department Location</label>
                            <input type="text" name="location" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="">Department Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Save</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function() {
            $('.department_select').on('change', function(event) {
                var new_deprt = event.currentTarget.value
                var user_id = event.currentTarget.dataset.userId
                $.ajax({
                    url: "/settings/change_department",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        user_id: user_id,
                        new_dept_id: new_deprt
                    },
                    dataType: 'json', // added data type
                    success: function(res) {
                        console.log(res)
                        if (res.code == 0) {
                            Swal.fire({
                                icon: 'success',
                                title: res.message,
                                showConfirmButton: false,
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: res.message,
                                showConfirmButton: false,
                            })
                        }
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
            })
        })
    </script>
@endsection
