@extends('layouts.app')

@section('title', 'Reisigersinformatie')

@push('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" 
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

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
                    datasets: {!! json_encode([[
                        "label" => "Temperatuur bord A",
                        'backgroundColor' => "hsla(167, 66%, 44%, 0.31)",
                        'borderColor' => "hsla(167, 66%, 44%, 0.7)",
                        "pointBorderColor" => "hsla(167, 66%, 44%, 0.7)",
                        "pointBackgroundColor" => "hsla(167, 66%, 44%, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $tempA,
                    ],
                    [
                        "label" => "Temperatuur bord B",
                        'backgroundColor' => "hsla(187, 66%, 44%, 0.31)",
                        'borderColor' => "hsla(187, 66%, 44%, 0.7)",
                        "pointBorderColor" => "hsla(187, 66%, 44%, 0.7)",
                        "pointBackgroundColor" => "hsla(187, 66%, 44%, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $tempB,
                    ]]) !!}
                },
                options: {
                    hoverMode: 'index',
                    stacked: false,
                    scales: {
                        xAxes: [{
                            id: 'x',
                            type: 'time',
                            time: {
                                unit: 'day'
                            },
                            ticks: {
                                autoSkip: true,
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            id: 'z',
                            ticks: {
                                autoSkip: true,
                                maxTicksLimit: 5,

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
                    datasets: {!! json_encode([[
                        "label" => "Luchtvochtigheid bord A",
                        'backgroundColor' => "hsla(0, 66%, 44%, 0.31)",
                        'borderColor' => "hsla(0, 66%, 44%, 0.7)",
                        "pointBorderColor" => "hsla(0, 66%, 44%, 0.7)",
                        "pointBackgroundColor" => "hsla(0, 66%, 44%, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $humidA,
                    ],
                    [
                        "label" => "Luchtvochtigheid bord B",
                        'backgroundColor' => "hsla(20, 66%, 44%, 0.31)",
                        'borderColor' => "hsla(20, 66%, 44%, 0.7)",
                        "pointBorderColor" => "hsla(20, 66%, 44%, 0.7)",
                        "pointBackgroundColor" => "hsla(20, 66%, 44%, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $humidB,
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
                                autoSkip: true,
                                maxTicksLimit: 5,
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
            <li class="breadcrumb-item active" aria-current="page">ReizigersInformatie</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="card mb-3">
                <div class="card-header container">
                    <div class="row">
                        <div class="m-2 text-center text-md-left">
                            <h2 class="mb-0">Instellingen</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST">
                        @csrf
    
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Licht helderheid</label>
                            <div class="btn-group btn-group-toggle form-control p-0" id="name" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                    <input value="darkly" type="radio" name="theme" autocomplete="off"> Uit
                                </label>
                                <label class="btn btn-secondary">
                                    <input value="default" type="radio" name="theme" autocomplete="off"> Auto
                                </label>
                                <label class="btn btn-secondary">
                                    <input value="superhero" type="radio" name="theme" autocomplete="off"> Aan
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">RGB mode</label>
                            <select name="icon_index" class="form-control">
                                <option value="0">Uit</option>
                                <option value="1">Aan</option>
                                <option value="2">Pulse</option>
                                <option value="3">Regenboog</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">RGB kleur</label>
                            <input class="form-control" type="color" name="color" value="#ff0000">
                        </div>
    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="mx-3 my-1 btn btn-primary" formaction="{{ route('usersettings') }}">
                                    Opslaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h2 class="mb-0">Grafieken</h2>
                </div>
                <div class="card-body">
                    <canvas id="temperature" height="200"></canvas>
                    <canvas id="humidity" height="200"></canvas>
                </div>
            </div>
        </div>
    
    
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header container">
                    <div class="row">
                        
                        <div class="col-md-8 my-2 text-center text-md-left">
                            <h2 class="mb-0">Splitflap beheer</h2>
                        </div>
        
                        <div class="col-md-4 text-center text-md-right">
                            <a href="{{route('board-setup')}}" class="ml-2 btn btn-primary"> <i class="fas fa-plus"></i></a>	
                            <a href="{{route('export-splitflaps')}}" class="m-2 btn btn-primary"> <i class="fas fa-cloud-download-alt"></i></a>						
                        </div>
                    </div>
                </div>
                
                <div class="card-body py-0 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Text</th>
                                    <th>Spoor</th>
                                    <th>Datum</th>
                                    <th>actie</th>
                                    <th class="text-right">voorbeeld</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                @if ($item->id == ($boardA[0]->id ?? '') || $item->id == ($boardB[0]->id ?? ''))
                                    <tr class="table-primary">
                                @else
                                    <tr>
                                @endif
                                        <td>
                                            <b>{{$item->first_text}} {{$item->second_text}}</b>
                                        </td>
                                        <td>
                                            {{$item->board}}
                                        </td>               
                                        <td>
                                            {{$item->time}}
                                        </td>
                                        <td>
                                            <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i title="Aanpassen" class="fas fa-cog"></i>
                                            </a>
                                            
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Bijwerken</a>
                                                <form method="POST" autocomplete="off" action="ris/verwijder/{{$item->id}}" id="delete-{{$item->id}}">
                                                    @csrf
                                                    <div onclick="confirmation('delete-{{$item->id}}')" class="btn dropdown-item"><i class="fas fa-trash-alt"></i> Verwijderen</div>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="dropdown text-right">
                                            <!-- Button to trigger modal -->
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-{{$item->id}}">
                                                Voorbeeld
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel">Voorbeeld</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <board-preview board_width="400" splitflapdata="{{$item}}"/>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td>
                                        geen data
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="hint-text">Pagina <b>{{$data->currentPage()}}</b> van de <b>{{$data->lastPage()}}</b> pagina's</div>
                        </div>
                        <div class="col-12  col-md-6">
                            <ul class="pagination justify-content-end">
                                {{ $data->links('vendor.pagination.simple-bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection