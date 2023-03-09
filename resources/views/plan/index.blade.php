@section('title', __('nav.show_plans'))
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
                    <th>{{ __('plan.plan_name') }}</th>
                    <th>{{ __('plan.description') }}</th>
                    <th>{{ __('plan.tasks') }}</th>
                    <th>{{ __('plan.parent_goal') }}</th>
                    <th>{{ __('plan.progress') }}</th>
                    <th>{{ __('plan.added_by') }}</th>
                    <th>{{ __('plan.status') }}</th>
                    <th>{{ __('plan.timeframe_start_date') }}</th>
                    <th>{{ __('plan.timeframe_end_date') }}</th>
                    <th>{{ __('plan.actual_end_date') }}</th>
                    <th>{{ __('plan.actions') }}</th>
                    <th>{{ __('plan.favorite') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->description }}</td>
                        <td><a href="{{ route('tasks.index') }}">
                                <i class="fa fa-bullseye opacity-25"></i> {{ $plan->tasks()->count() }}
                            </a></td>
                        <td>{{ $plan->goal()->first()->name ?? '' }}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $plan->complete_tasks_percent() }}%"
                                    aria-valuenow="{{ $plan->complete_tasks()->count() }}" aria-valuemin="0"
                                    aria-valuemax="{{ $plan->tasks()->count() }}">
                                    {{ $plan->complete_tasks_percent() }}%
                                </div>
                            </div>
                        </td>

                        <td>{{ $plan->created_by()->first()->name }}</td>
                        <td>
                            @if ($plan->status == 0)
                                <span class="badge bg-primary rounded">Pending</span>
                            @elseif ($plan->status == 1)
                                <span class="badge bg-success rounded">Complete</span>
                            @elseif ($plan->status == 2)
                                <span class="badge bg-danger rounded">Exceeded</span>
                            @endif
                        </td>
                        <td>{{ $plan->timeframe_start_date }}</td>
                        <td>{{ $plan->timeframe_end_date }}</td>
                        <td>{{ $plan->actual_end_date }}</td>
                        <td class="text-center">
                            <a href="plans/{{ $plan->id }}" class="btn" role="button"><i
                                    class="fa fa-eye text-success"></i></a>|
                            <a href="plans/{{ $plan->id }}/edit" class="btn" role="button"><i
                                    class="fa fa-pen text-primary"></i></a>|
                            <form action="plans/{{ $plan->id }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button class="btn with-confirm" type="submit"><i
                                        class="fa fa-trash text-danger"></i></button>
                            </form>
                        </td>
                        <td class="text-center">
                            @if ($plan->type)
                                <a href="plans/{{ $plan->id }}/favorite">
                                    <span class="fav">☆</span>
                                </a>
                            @else
                                <a href="plans/{{ $plan->id }}/favorite">
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
                "autoWidth": false,
                dom: "<'row'<'col-sm-3 custom-search  d-flex justify-content-center align-items-center'><'col-sm-3 custom-filter  d-flex justify-content-center align-items-center'><'col-sm-6 toolbar d-flex justify-content-end align-items-center'>>" +
                    "<'row'<'col-sm-12  d-flex justify-content-center align-items-center'tr>>" +
                    "<'row'<'col-sm-4  d-flex justify-content-center align-items-end'i><'col-sm-4  d-flex justify-content-center align-items-end'l><'col-sm-4  d-flex justify-content-center align-items-end'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs": [{
                        orderable: false,
                        targets: [0, 1, 2, 3, 4, 5, 6, 9, 10, 11]
                    }, {
                        "orderable": true,
                        "target": 7,
                        "data": "timeframe_start_date",
                        "type": "date",
                        "render": function(value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                        }
                    },
                    {
                        "orderable": true,
                        "target": 8,
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
                        '<a class="btn btn-primary" role="button" href="{{ route('plans.create') }}">{{ __('plan.add_plan') }}</a>'
                    );
                    $('div.custom-search').html(
                        '<div class="input-group">' +
                        '<span class="input-group-text" id="basic-myCustomSearchBox"><i class="fa fa-search"></i></span>' +
                        '<input type="text" id="myCustomSearchBox" class="form-control" placeholder="{{ __('plan.search') }}" aria-label="myCustomSearchBox" aria-describedby="basic-myCustomSearchBox">' +
                        '</div>'
                    );
                    $('div.custom-filter').html(
                        '<select class="form-select" id="myCustomFilterSelect">' +
                        '<option selected > {{ __('plan.plan_type') }} </option>' +
                        '<option value = "1" > {{ __('plan.favorite') }} </option>' +
                        '<option value = "2" > {{ __('plan.my_plans') }}</option>' +
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
                    else if (val == 2) // my plans
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
