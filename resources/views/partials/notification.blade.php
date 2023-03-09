<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notifications</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <table class="table table-striped table-sm" style="font-size: .7rem">
            <thead>
                <tr>
                    <th>
                        Plan Name
                    </th>
                    <th>
                        Timeframe End Date
                    </th>
                    <th>
                        Actual End Date
                    </th>
                    <th>
                        Days Passed
                    </th>
                    <th>
                        Assigned To User
                    </th>
                    <th>Mark As Read</th>
                </tr>
            </thead>
            <tbody>
                @forelse($slakers['plans'] as  $slaker)
                    <tr>
                        <td>{{ $slaker->name }}</td>
                        <td>{{ $slaker->timeframe_end_date }}</td>
                        <td>{{ $slaker->actual_end_date }}</td>
                        <td>{{ \Carbon\Carbon::parse($slaker->actual_end_date)->diff(\Carbon\Carbon::parse($slaker->timeframe_end_date))->days }}
                        </td>
                        <td>{{ $slaker->assigned_to()->first()->name }}</td>
                        <td><a href="{{ route('plans.mark_as_read' , $slaker) }}" class="text-success text-decoration-underline with-confirm"><i
                                    class="fa fa-eye"></i></a></td>
                    </tr>
                @empty
                    <h4>No Delays On Plan to Show</h4>
                @endforelse
            </tbody>

        </table>




    </div>
</div>
