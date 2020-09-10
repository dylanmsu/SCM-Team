@extends('layouts.app')

@section('title', 'Eigenschappen')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vehicles')}}">Rollend Matrieel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Eigenschappen</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-5 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7 col-lg-12 col-xl-7 text-center text-sm-left text-lg-center text-xl-left">
                                <h4 class="mt-2">Eigenschappen</h4>
                            </div>
                            <div class="col-sm-5 col-lg-12 col-xl-5 my-2 text-center text-sm-right text-lg-center text-xl-right">
                                <a data-toggle="modal" data-target="#modal-prop" class="ml-2 btn btn-primary"> <i class="fas fa-plus"></i> Toevoegen</a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal-prop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" enctype="multipart/form-data" action="/rollend/prop/toevoegen/{{$data[0]->id}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">Voorbeeld</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="input_fields_wrap">
                                                        <div class="mb-1 input-group">
                                                            <input placeholder="Eigenschap" class="form-control col" type="text" name="prop[]" required/>
                                                            <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                                            <div id="addbtn" class="col-1 btn btn-primary add_field_button">+</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody>

                                    @forelse ($data[0]->vehicle_property as $item)
                                    <tr>
                                        <td class="p-1 text-right"><b>{{$item->key}}</b>: </td><td class="p-1 text-left">{{$item->value}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center">Voeg een eigenschap toe</td>
                                    </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5 my-2 text-center text-sm-left">
                                <h2 class="mb-0">{{$data[0]->name}}</h2>
                            </div>
                            <div class="col-sm-7 my-2 text-center text-sm-right">
                                <a data-toggle="modal" data-target="#modal-img" class="ml-2 btn btn-primary"> <i class="fas fa-plus"></i> Afbeeldingen toevoegen</a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" enctype="multipart/form-data" action="/rollend/img/toevoegen/{{$data[0]->id}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">Voorbeeld</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <input id="image" type="file" class="form-control-file" name="image[]" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @forelse ($data[0]->vehicle_file as $item)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" @if($loop->first) class="active" @endif></li>
                            @empty
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            @endforelse
                        </ol>
                        <div class="carousel-inner">
                            @forelse ($data[0]->vehicle_file as $item)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img class="d-block w-100" src="{{asset('storage/vehicle_img').'/'.$item->url}}" alt="slide">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="https://via.placeholder.com/1920x1080">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="https://via.placeholder.com/1920x1080">
                                </div>
                            @endforelse
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection