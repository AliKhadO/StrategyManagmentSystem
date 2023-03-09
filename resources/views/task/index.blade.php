@section('title', __('nav.show_tasks'))
@extends('layouts.layout')
@section('styles')
    <style>
        div.dataTables_wrapper div.dataTables_filter {
            text-align: start
        }

        .table thead,
        .table th {
            text-align: center !important;
        }
    </style>
@endsection

@section('content')
    <div class="w-100">
        <hr>
        <div class="list-group mt-3">
            @can('add tasks')
                <li class="list-group-item">
                    <form action="{{ route('tasks.store') }}" method="post">
                        @csrf
                        <input type="text" name="name" class="form-control" placeholder="Task Name">
                        <textarea name="description" id="" cols="30" rows="2" class="form-control mt-1"
                            placeholder="Task Description"></textarea>
                        <select class="form-select mt-1" name="assigned_to_id">
                            <option selected>Assign To User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-select mt-1" name="plan_id">
                            <option selected>Parent Plan</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mt-1"><i class="fa fa-add"></i></button>
                    </form>
                </li>
            @endcan
            @forelse ($tasks as $task)
                <a href="{{ route('tasks.edit', $task->id) }}"
                    class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $task->name }}</h5>
                        <small>{{ calculateDateDiff($task->created_at, now()) }} days ago</small>
                    </div>
                    <p class="mb-1">{{ $task->description }}</p>
                    <small>Created By :{{ $task->created_by->name }}</small> on <small>{{ $task->created_at }}</small>
                    <p>parent plan <mark >{{ $task->parent_plan->name }}</mark> </p>
                    <small>
                        @can('delete tasks')
                            <form action="tasks/{{ $task->id }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button class="btn with-confirm" type="submit"><i class="fa fa-trash text-danger"></i></button>
                            </form>
                        @endcan
                    </small>

                </a>

            @empty
                <li>No Data</li>
            @endforelse
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            dTable = $('#table_id').DataTable({
                "autoWidth": false,
                dom: "<'row'<'col-sm-3 custom-search  d-flex justify-content-center align-items-center'><'col-sm-3 custom-filter  d-flex justify-content-center align-items-center'><'col-sm-6 toolbar d-flex justify-content-end align-items-center'>>" +
                    "<'row'<'col-sm-12  d-flex justify-content-center align-items-center'tr>>" +
                    "<'row'<'col-sm-4  d-flex justify-content-center align-items-end'i><'col-sm-4  d-flex justify-content-center align-items-end'l><'col-sm-4  d-flex justify-content-center align-items-end'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs": [{
                        orderable: false,
                        targets: [0, 1, 2, 3, 4, 5, 6, 9, 10]
                    }, {
                        "orderable": true,
                        "target": 6,
                        "data": "timeframe_start_date",
                        "type": "date",
                        "render": function(value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                        }
                    },
                    {
                        "orderable": true,
                        "target": 7,
                        "data": "timeframe_end_date",
                        "type": "date",
                        "render": function(value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                        }
                    },
                    {
                        "target": 10,
                        "width": "15%"
                    }
                ],
                fnInitComplete: function() {
                    $('div.toolbar').html(
                        '<a class="btn btn-primary" role="button" href="{{ route('tasks.create') }}">{{ __('task.add_task') }}</a>'
                    );
                    $('div.custom-search').html(
                        '<div class="input-group">' +
                        '<span class="input-group-text" id="basic-myCustomSearchBox"><i class="fa fa-search"></i></span>' +
                        '<input type="text" id="myCustomSearchBox" class="form-control" placeholder="{{ __('task.search') }}" aria-label="myCustomSearchBox" aria-describedby="basic-myCustomSearchBox">' +
                        '</div>'
                    );
                    $('div.custom-filter').html(
                        '<select class="form-select" id="myCustomFilterSelect">' +
                        '<option selected > {{ __('task.task_type') }} </option>' +
                        '<option value = "1" > {{ __('task.favorite') }} </option>' +
                        '<option value = "2" > {{ __('task.my_tasks') }}</option>' +
                        '</select>'
                    );
                },
                "language": {
                    "url": $('html').attr('lang') == 'ar' ?
                        "//cdn.datatables.net/plug-ins/1.12.1/i18n/ar.json" : ""
                }
            });

            $('#table_id_filter input').attr('placeholder', 'Start Typing to Search for Goals');
            $(document)
                .on('keyup', '#myCustomSearchBox', function() {
                    dTable.search($(this).val())
                        .draw(); // this  is for customized searchbox with datatable search feature.
                });
            $(document)
                .on('change', '#myCustomFilterSelect', function(event) {
                    let val = event.currentTarget.value
                    //console.log(val)
                    if (val == 1) // my favoriate
                        dTable.search('★')
                        .draw(); // this  is for customized searchbox with datatable search feature.
                    else if (val == 2) // my tasks
                        dTable
                        .column(5).search('{{ Auth::user()->name }}').draw()
                    else {
                        dTable
                            .search('')
                            .columns().search('')
                            .draw();

                    }
                });
        });
    </script>
@endsection
