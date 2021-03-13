@extends('layouts.chart-layout')
@section('content')


    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-md-6 mb-3">
                <canvas id="myChart" width="200px" height="200px"></canvas>
            </div>


            <div class="col-xs-12 col-md-6">
                <canvas id="myChart2" width="200px" height="200px"></canvas>

            </div>
        </div>

        <script type="application/javascript">
            var ctx = document.getElementById('myChart');
            var year = <?php echo $year; ?>;        console.log(year);
            var order = <?php echo $chartTotal; ?>;        console.log(order);
            var months = <?php echo $months; ?>;        console.log(months);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Incasso anno' + ' ' + year,
                        data: order,

                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        onClick: null,
                        labels: {
                            boxSize: 0,
                            boxWidth: 0,
                        }
                    },
                    tooltips: {
                        custom: function(tooltipModel) {
                            tooltipModel.opacity = 0;
                        }
                    },
                    parsing: {
                        xAxisKey: 'year',
                        yAxisKey: 'month'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }

            });

        </script>

        <script>
            var ctx = document.getElementById('myChart2');
            var year = <?php echo $year; ?>;        var order = <?php echo $chartOrder; ?>;        console.log(order);
            var months = <?php echo $months; ?>;        console.log(months);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Ordini anno ' + year,
                        data: order,

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
                    legend: {
                        onClick: null,
                        labels: {
                            boxSize: 0,
                            boxWidth: 0,
                        }
                    },
                    tooltips: {
                        custom: function(tooltipModel) {
                            tooltipModel.opacity = 0;
                        }
                    },
                    parsing: {
                        xAxisKey: 'year',
                        yAxisKey: 'month'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }

            });

        </script>
        <div class="d-flex justify-content-center">
            <a href="{{ route('orders.index') }}" class=" btn btn-secondary mt-3 mb-3">Ritorna agli
                ordini</a>
        </div>

    </div>

@endsection
