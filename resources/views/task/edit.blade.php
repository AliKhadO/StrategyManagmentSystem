@extends('layouts.layout')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="task-tab" data-bs-toggle="tab" data-bs-target="#task" type="button"
                        role="tab" aria-controls="task" aria-selected="true">Task Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#traking" type="button"
                        role="tab" aria-controls="traking" aria-selected="true">Process Tracking</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="criteria-tab" data-bs-toggle="tab" data-bs-target="#criteria"
                        type="button" role="tab" aria-controls="criteria" aria-selected="false">Criterias</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="risks-tab" data-bs-toggle="tab" data-bs-target="#risks" type="button"
                        role="tab" aria-controls="risks" aria-selected="false">Risks</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="updates-tab" data-bs-toggle="tab" data-bs-target="#updates" type="button"
                        role="tab" aria-controls="updates" aria-selected="false">Updates</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="task" role="tabpanel" aria-labelledby="task-tab">
                    <h4 class="mt-3">Task Details</h4>
                    <form action="/tasks/{{ $task->id }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $task->id }}" class="form-control">
                        <div class="mt-3">
                            <label for="">Task Name</label>
                            <input type="text" name="name" value="{{ $task->name }}" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="">Task Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"> {{ $task->description }} </textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Update</button>
                    </form>

                </div>
                <div class="tab-pane fade show" id="traking" role="tabpanel" aria-labelledby="traking-tab">
                    <canvas id="trakingChart" width="400" height="400" class="mt-4 me-auto ms-2"></canvas>
                </div>
                <div class="tab-pane fade" id="criteria" role="tabpanel" aria-labelledby="criteria-tab">
                    <ul class="list-group mt-3">
                        @foreach ($task->criterias()->get() as $criteria)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto w-100">
                                    <div class="fw-bold">{{ $criteria->title }}</div>
                                    <div class="mt-1">
                                        <label for="customRange1" class="form-label">Complete Range</label>

                                        <div class="d-flex justify-content-around align-items-center">
                                            <span>0</span>
                                            <input type="range" data-update-id="{{ $criteria->id }}" min="0"
                                                max="100" value="{{ $criteria->complete_percent }}"
                                                class="form-range update-range" id="customRange1">
                                            <span>100%</span>
                                        </div>
                                    </div>
                                    Form Date : {{ $criteria->from }} , To Date : {{ $criteria->to }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <a class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#criteriaModal">Add
                        Criteria</a>
                </div>
                <div class="tab-pane fade" id="risks" role="tabpanel" aria-labelledby="risks-tab">
                    <ul class="list-group mt-3">
                        @foreach ($task->risks()->get() as $risk)
                            <a href="{{ route('risk.complete', $risk->id) }}"
                                class="list-group-item list-group-item-action {{ $risk->completed ? 'line-throwgh' : '' }} {{ $risk->type == 1 ? 'list-group-item-warning' : '' }} {{ $risk->type == 2 ? 'list-group-item-danger' : '' }}">{{ $risk->title }}</a>
                        @endforeach
                    </ul>
                    <a class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#riskModal">Add Risk</a>
                </div>
                <div class="tab-pane fade" id="updates" role="tabpanel" aria-labelledby="updates-tab">
                    <ul class="list-group mt-3">
                        @foreach ($task->updates()->get() as $update)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $update->title }}</div>
                                    {{ $update->update }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <a class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#updateModal">Add Update</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="riskModal" tabindex="-1" aria-labelledby="riskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="riskModalLabel">Add Risk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('risk.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="task_id" name="task_id" value="{{ $task->id }}"
                            class="form-control">
                        <div class="mt-3">
                            <label for="">Risk Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mt-3">
                            <select class="form-select" name="type">
                                <option value="0">Low Risk</option>
                                <option value="1">Moderate Risk</option>
                                <option value="2">High Risk</option>
                            </select>
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


    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Add Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="task_id" name="task_id" value="{{ $task->id }}"
                            class="form-control">
                        <div class="mt-3">
                            <label for="">Update Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="">Update Description</label>
                            <input type="text" name="update" class="form-control">
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


    <!-- Modal -->
    <div class="modal fade" id="criteriaModal" tabindex="-1" aria-labelledby="criteriaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="criteriaModalLabel">Add Criteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('criteria.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="task_id" name="task_id" value="{{ $task->id }}"
                            class="form-control">
                        <div class="mt-3">
                            <label for="">Criteria Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="">Criteria Description</label>
                            <input type="text" name="update" class="form-control">
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="">Start Date</label>
                                <input type="date" name="from" class="form-control">
                            </div>
                            <div class="col">
                                <label for="">End Date</label>
                                <input type="date" name="to" class="form-control">
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
        $('.update-range').on('change', function(event) {
            let val = event.currentTarget.value;
            let targetId = event.currentTarget.dataset.updateId;
            //update complete percentage
            $.ajax({
                url: "/criteria/complete",
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: targetId,
                    value: val
                },
                dataType: 'json', // added data type
                success: function(res) {
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
                }
            });
        })
        var ctx = document.getElementById("trakingChart");
        var complete_percent;
        $.ajax({
            url: "/tasks/{{ $task->id }}/complete",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                console.log(res)
                complete_percent = res.data
                if (res.code == 0) {
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Completed', 'In Progress'],
                            datasets: [{
                                label: 'Task Completion',
                                data: [complete_percent, 100 - complete_percent],
                                backgroundColor: [
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            //cutoutPercentage: 40,
                            responsive: false,

                        }
                    });



                } else
                    complete_percent = 0;
            }
        });
    </script>
@endsection
