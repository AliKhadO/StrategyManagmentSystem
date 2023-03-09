@section('title', __('nav.reports'))
@extends('layouts.layout')
@section('styles')
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-1 col-12">
            <h4>Plans Report</h4>
        </div>
        <div class="col-lg-3 col-12">
            <canvas id="planChart" style="max-height: 50vh"></canvas>
        </div>
        <div class="col-lg-1 col-12">
            <h4>Goals Report</h4>
        </div>
        <div class="col-lg-3 col-12">
            <canvas id="goalsChart" style="max-height: 50vh"></canvas>
        </div>
        <div class="col-lg-1 col-12">
            <h4>Tasks Report</h4>
        </div>
        <div class="col-lg-3 col-12">
            <canvas id="tasksChart" style="max-height: 50vh"></canvas>
        </div>
    </div>

    <hr>
    </div>
@endsection
@section('script')
    <script>
        $.ajax({
            url: '{{ route('reports.plans') }}',
            method: 'GET',
            dataType: 'json',
            success: function(d) {
                const ctx = document.getElementById('planChart');
                const myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(d),
                        datasets: [{
                            label: '# of Plans',
                            data: Object.values(d),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });


        $.ajax({
            url: '{{ route('reports.tasks') }}',
            method: 'GET',
            dataType: 'json',
            success: function(d) {
                const ctx = document.getElementById('tasksChart');
                const myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(d),
                        datasets: [{
                            label: '# of Tasks',
                            data: Object.values(d),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });

        $.ajax({
            url: '{{ route('reports.goals') }}',
            method: 'GET',
            dataType: 'json',
            success: function(d) {
                const ctx = document.getElementById('goalsChart');
                const myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(d),
                        datasets: [{
                            label: '# of Goals',
                            data: Object.values(d),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
