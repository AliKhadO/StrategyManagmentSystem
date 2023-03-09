@section('title', __('nav.show_goals'))
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
        <table id="table_id" class="table border rounded">
            <thead>
                <tr class="table-light">
                    <th>{{ __('goal.goal_name') }}</th>
                    <th>{{ __('goal.description') }}</th>
                    <th>{{ __('goal.plans') }}</th>
                    <th>{{ __('goal.progress') }}</th>
                    <th>{{ __('goal.added_by') }}</th>
                    <th>{{ __('goal.status') }}</th>
                    <th>{{ __('goal.timeframe_start_date') }}</th>
                    <th>{{ __('goal.timeframe_end_date') }}</th>
                    <th>{{ __('goal.actual_end_date') }}</th>
                    <th>{{ __('goal.actions') }}</th>
                    <th>{{ __('goal.favorite') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goals as $goal)
                    <tr>
                        <td>{{ $goal->name }}</td>
                        <td>{{ $goal->description }}</td>
                        <td><a href="{{ route('goals.index') }}">
                                <i class="fa fa-bullseye opacity-25"></i> {{ $goal->plans()->count() }}
                            </a></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $goal->complete_plans_percent() }}%"
                                    aria-valuenow="{{ $goal->complete_plans()->count() }}" aria-valuemin="0"
                                    aria-valuemax="{{ $goal->plans()->count() }}">
                                    {{ $goal->complete_plans_percent() }}%
                                </div>
                            </div>
                        </td>
                        <td>{{ $goal->created_by()->first()->name }}</td>
                        <td>
                            @if ($goal->status == 0)
                                <span class="badge bg-primary rounded">Pending</span>
                            @elseif ($goal->status == 1)
                                <span class="badge bg-success rounded">Complete</span>
                            @elseif ($goal->status == 2)
                                <span class="badge bg-danger rounded">Exceeded</span>
                            @endif
                        </td>
                        <td>{{ $goal->timeframe_start_date }}</td>
                        <td>{{ $goal->timeframe_end_date }}</td>
                        <td>{{ $goal->actual_end_date }}</td>
                        <td class="text-center">
                            <a href="goals/{{ $goal->id }}" class="btn" role="button"><i
                                    class="fa fa-eye text-success"></i></a>|
                            <a href="goals/{{ $goal->id }}/edit" class="btn" role="button"><i
                                    class="fa fa-pen text-primary"></i></a>|
                            <form action="goals/{{ $goal->id }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button class="btn with-confirm" type="submit"><i class="fa fa-trash text-danger"></i></button>
                            </form>
                        </td>
                        <td class="text-center">
                            @if ($goal->type)
                                <a href="goals/{{ $goal->id }}/favorite">
                                    <span class="fav">☆</span>
                                </a>
                            @else
                                <a href="goals/{{ $goal->id }}/favorite">
                                    <span class="fav">★</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            dTable = $('#table_id').DataTable({
                scrollX: true,
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
                        "target": 9,
                        "width": "15%"
                    }
                ],
                fnInitComplete: function() {
                    $('div.toolbar').html(
                        '<a class="btn btn-primary" role="button" href="{{ route('goals.create') }}">{{ __('goal.add_goal') }}</a>'
                    );
                    $('div.custom-search').html(
                        '<div class="input-group">' +
                        '<span class="input-group-text" id="basic-myCustomSearchBox"><i class="fa fa-search"></i></span>' +
                        '<input type="text" id="myCustomSearchBox" class="form-control" placeholder="{{ __('goal.search') }}" aria-label="myCustomSearchBox" aria-describedby="basic-myCustomSearchBox">' +
                        '</div>'
                    );
                    $('div.custom-filter').html(
                        '<select class="form-select" id="myCustomFilterSelect">' +
                        '<option selected > {{ __('goal.goal_type') }} </option>' +
                        '<option value = "1" > {{ __('goal.favorite') }} </option>' +
                        '<option value = "2" > {{ __('goal.my_goals') }}</option>' +
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
                    else if (val == 2) // my goals
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
