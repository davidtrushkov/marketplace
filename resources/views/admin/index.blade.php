@extends('admin.layouts.default')

@section('admin.content')
    @if(!$overallSales->isEmpty())
        <div class="ACCOUNT-CHART-CONTAINER col-sm-12 no-padding">
            <div class="panel panel-default">
                <div class="panel-heading">Sales Data</div>
                <div class="panel-body">
                    <ul class="nav nav-tabs" role="tablist">
                        @if($overallSales->count() > 1)
                            <li role="presentation" class="{{ $overallSales->count() > 1 ? 'active' : '' }}">
                                <a href="#salesAllTime" aria-controls="salesAllTime" role="tab" data-toggle="tab">All Time Sales</a>
                            </li>
                        @endif
                        @if(!$salesThisMonth->isEmpty())
                            <li role="presentation" class="{{ !$salesThisMonth->isEmpty() && $overallSales->count() < 2 ? 'active' : '' }}">
                                <a href="#salesThisMonth" aria-controls="salesThisMonth" role="tab" data-toggle="tab">Sales this Month</a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        @if($overallSales->count() > 1)
                            <div role="tabpanel" class="tab-pane {{ $overallSales->count() > 1 ? ' active' : '' }}" id="salesAllTime">
                                <div class="col-sm-12 no-padding">
                                    <canvas id="allTimeSalesChartAdmin" width="400" height="300"></canvas>
                                </div>
                            </div>
                        @endif
                        @if(!$salesThisMonth->isEmpty())
                            <div role="tabpanel" class="tab-pane {{ !$salesThisMonth->isEmpty() && $overallSales->count() < 2 ? 'active' : '' }}" id="salesThisMonth">
                                <div class="col-sm-12 no-padding">
                                    <canvas id="salesThisMonthChartAdmin" width="400" height="300"></canvas>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
    <script>
        var ctx = document.getElementById('salesThisMonthChartAdmin').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($salesThisMonth as $key => $sale)"{{ $key }}",@endforeach],
                datasets: [{
                    label: "Sold that day",
                    backgroundColor: '#1e88e5',
                    borderColor: '#1a60b5',
                    data: [@foreach($salesThisMonth as $total)"{{ $total }}", @endforeach],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                title: {
                    display: true,
                    padding: 40,
                    text: 'Total price sold per day starting this month (' + (new Date()).getFullYear() + ')'
                },
                legend: {
                    display: false
                },
                tooltips: {
                    displayColors: false,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return 'Total sales of $' + tooltipItems.yLabel;
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                    }],
                    yAxes: [{
                        display: true,
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + parseFloat(Math.round(value * 100) / 100).toFixed(2);
                            },
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('allTimeSalesChartAdmin').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [@foreach($overallSales as $key => $sale)"{{ $key }}",@endforeach],
                datasets: [{
                    label: "Sold that month",
                    backgroundColor: '#1e88e5',
                    borderColor: '#1a60b5',
                    data: [@foreach($overallSales as $total)"{{ $total }}", @endforeach],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                title: {
                    display: true,
                    padding: 40,
                    text: 'Total price sold per month that had sales'
                },
                legend: {
                    display: false
                },
                tooltips: {
                    displayColors: false,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return 'Total sales of $' + tooltipItems.yLabel;
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                    }],
                    yAxes: [{
                        display: true,
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + parseFloat(Math.round(value * 100) / 100).toFixed(2);
                            },
                        }
                    }]
                }
            }
        });
    </script>
@endsection