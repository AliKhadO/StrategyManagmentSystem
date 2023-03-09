@extends('layouts.layout')
@section('content')
    <div class="d-flex justify-content-around alig-items-center align-self-stretch">
        <div class="w-100 me-2">
            <h4>Users:</h4>
            <ul class="list-group mt-3">
                @forelse ($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $user->name . ' ' . $user->last_name }}</div>
                            {{ $user->email }}
                        </div>
                        <div>
                            @can('edit tasks')
                                <a href="user/{{ $user->id }}/edit" class="btn" role="button"><i
                                        class="fa fa-pen text-primary"></i></a>|
                            @endcan
                            @can('delete tasks')
                                <form action="user/{{ $user->id }}" method="post" class="d-inline">
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
            <a class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#userModal">Add User</a>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <h4>Default Password Is 'password'</h4>
                        <div class="mt-3">
                            <label for="">User Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="">User Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="">User Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="mt-3">
                            <div class="ms-2">
                                <span class="fw-bold">Role: </span>
                                <select class="form-select" name="role">
                                    <option value="specialist">Specialist</option>
                                    <option value="admin">Admin</option>
                                    <option value="team_leader">Team Leader</option>
                                    <option value="manager">Manager</option>
                                </select>
                            </div>
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
            $('.user_select').on('change', function(event) {
                var new_deprt = event.currentTarget.value
                var user_id = event.currentTarget.dataset.userId
                $.ajax({
                    url: "/settings/change_user",
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
