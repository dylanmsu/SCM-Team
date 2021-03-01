@extends('layouts.app')

@section('title', 'Grafieken')

@push('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" 
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.js"></script>

@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
            "use strict";
            window.temperature = new Chart(document.getElementById("temperature"), {
                responsive:true,
                maintainAspectRatio: false,
                type: 'line',
                data: {
                    labels: {!! json_encode($data->pluck('created_at')) !!},
                    datasets: {!! json_encode([[
                        "label" => "Temperatuur",
                        'backgroundColor' => "hsla(167, 66%, 44%, 0.31)",
                        'borderColor' => "hsla(167, 66%, 44%, 0.7)",
                        "pointBorderColor" => "hsla(167, 66%, 44%, 0.7)",
                        "pointBackgroundColor" => "hsla(167, 66%, 44%, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $data->pluck('temperature'),
                    ]]) !!}
                },
                options: {
                    scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                // Include a °C sign in the ticks
                                callback: function(value, index, values) {
                                    return value + '°C';
                                }
                            }
                        }]
                    }
                }
            });
            window.humidity = new Chart(document.getElementById("humidity"), {
                responsive:true,
                maintainAspectRatio: false,
                type: 'line',
                data: {
                    labels: {!! json_encode($data->pluck('created_at')) !!},
                    datasets: {!! json_encode([[
                        "label" => "Luchtvochtigheid",
                        'backgroundColor' => "hsla(230, 66%, 44%, 0.31)",
                        'borderColor' => "hsla(230, 66%, 44%, 0.7)",
                        "pointBorderColor" => "hsla(230, 66%, 44%, 0.7)",
                        "pointBackgroundColor" => "hsla(230, 66%, 44%, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $data->pluck('humidity'),
                    ]]) !!}
                },
                options: {
                    scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                                unit: 'day'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                // Include a percent sign in the ticks
                                callback: function(value, index, values) {
                                    return value + '%';
                                }
                            }
                        }]
                    }
                }
        });
    });
</script>
@endpush

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('user_settings')}}">Instellingen</a></li>
            <li class="breadcrumb-item active" aria-current="page">Grafieken</a></li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-sm-12 col-lg-6">
            <div class="card py-2">
                <div class="container">
                    <div style="width:100%;">
                        <canvas id="temperature"></canvas>
                        <canvas id="humidity"></canvas>
                    </div>
                </div>
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection