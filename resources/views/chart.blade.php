@extends('layouts.app') @section('content')
<script src="{{ asset('js/Chart.bundle.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>{{ $chart->name }}</h1>
            <hr>
            <div class="row">
                <canvas id="canvas"></canvas>
            </div>
            <script>
                var config = {
                    type: 'line',
                    data: {
                        datasets: [
                            @php
                            $i = 0
                            @endphp
                            @foreach($data as $d)
                            {
                                label: "{{ $d['chartField'] }}",
                                backgroundColor: window.chartColorsArr[{{ $i }}],
                                borderColor: window.chartColorsArr[{{ $i }}],
                                data: [
                                    @foreach($d['data'] as $dataEntry) 
                                    {
                                        x: new Date("{{ $dataEntry->datetime }}"),
                                        y: {{ $dataEntry->value }}
                                    },
                                    @endforeach
                                ],
                                fill: false,
                            }, 
                            @php
                            $i++
                            @endphp
                            @endforeach
                        ]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: '{{ $chart->name }}'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                type: 'time',
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Value'
                                }
                            }]
                        }
                    }
                };

                window.onload = function () {
                    var ctx1 = document.getElementById("canvas").getContext("2d");
                    @if($chart->type=="linechart") 
                    window.myLine = new Chart(ctx1, config);
                    @endif
                    @if($chart->type=="scatter") 
                    window.myLine = new Chart.Scatter(ctx1, config);
                    @endif
                };
            </script>
        </div>
    </div>
</div>
@endsection