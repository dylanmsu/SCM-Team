@extends('layouts.app')

@section('title', 'Rollend Materieel')

@section('content')
<div class="container">

    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vehicles')}}">Rollend Matrieel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Eigenschappen</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="mb-4 card">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="mt-2">Eigenschappen</h4>
                            </div>
                            <div class="col-4 text-right my-2">
                                <a data-toggle="modal" data-target="#modal-prop" class="ml-2 btn btn-primary"> <i class="fas fa-plus"></i></a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal-prop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" id="prop-add-{{$data[0]->id}}" enctype="multipart/form-data" action="/rollend/prop/toevoegen/{{$data[0]->id}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">Eigenschappen toevoegen</h5>
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
                                                    <input type="submit" class="btn btn-primary" onclick="return confirmation('prop-add-{{$data[0]->id}}')">
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

            <div class="card mb-4">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="mt-2">Documenten</h4>
                            </div>
                            <div class="col-4 text-right my-2">
                                <a data-toggle="modal" data-target="#modal-doc" class="ml-2 btn btn-primary"> <i class="fas fa-plus"></i></a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal-doc" tabindex="-1" role="dialog" aria-labelledby="documentupload" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" enctype="multipart/form-data" id="doc-add-{{$data[0]->id}}" action="/rollend/doc/toevoegen/{{$data[0]->id}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="documentupload">Documenten uploaden</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="image" class="col-lg-4 col-form-label text-lg-right">Afbeeldingen trein</label>
                                                                
                                                                <div class="col-lg-7 text-left">
                                                                    <label class="btn btn-primary" id="doc-iput-label" for="my-file-selector">
                                                                        <input name="docs[]" id="my-file-selector" type="file" style="display:none" 
                                                                        onchange="$('#upload-file-info').html(this.files[0].name)">
                                                                        Kies bestanden
                                                                    </label>
                                                                    <span class='label label-info' id="upload-file-info"></span>
                                                                </div>
                                                            </div>
                                
                                                            <div class="form-group row">
                                                                <label for="image" class="col-lg-4 col-form-label text-lg-right">Documenten</label>
                                                                
                                                                <div class="col-lg-7">
                                                                    <select name="file_category" class="form-control" id="category" required>
                                                                        <option value="dossier">Dossiers</option>
                                                                        <option value="handleiding">Handleidingen</option>
                                                                        <option value="info">Informatie</option>
                                                                        <option value="attest">Attesten</option>
                                                                        <option value="anderen">Anderen</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary" onclick="return confirmation('doc-add-{{$data[0]->id}}')">
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

                                    @forelse ($data[0]->vehicle_file->where('type', 'doc') as $item)
                                    <tr>
                                        <td class="p-2"></td>
                                        <td class="p-1 text-right"><b>{{$item->category}}</b>: </td><td class="p-1 text-left"><a href="{{asset($item->url)}}">{{$item->name}}</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center">Geen documenten beschikbaar.</td>
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
            <div class="card mb-4">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-0"><b>{{$data[0]->name}}</b></h3>
                            </div>
                            <div class="col-4 text-right my-2">
                                <a data-toggle="modal" data-target="#modal-img" class="ml-2 btn btn-primary"> <i class="fas fa-plus"></i></a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" enctype="multipart/form-data" id="img-add-{{$data[0]->id}}" action="/rollend/img/toevoegen/{{$data[0]->id}}">
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
                                                    <input type="submit" class="btn btn-primary" onclick="return confirmation('img-add-{{$data[0]->id}}')">
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
                    <div id="carouselExampleControls" class="carousel slide">
                        <ol class="carousel-indicators">
                            @forelse ($data[0]->vehicle_file->where('type', 'img') as $item)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" @if($loop->first) class="active" @endif></li>
                            @empty
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            @endforelse
                        </ol>
                        <div class="carousel-inner">
                            @forelse ($data[0]->vehicle_file->where('type', 'img') as $item)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img class="d-block w-100" src="{{asset($item->url)}}" alt="slide">
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

            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="mt-2">Keuringen</h4>
                            </div>
                            <div class="col-4 text-right my-2">
                                <a data-toggle="modal" data-target="#modal-exam" class="ml-2 btn btn-primary"> <i class="fas fa-plus"></i></a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal-exam" tabindex="-1" role="dialog" aria-labelledby="documentupload" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" enctype="multipart/form-data" id="exam-add-{{$data[0]->id}}" action="/rollend/exam/toevoegen/{{$data[0]->id}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="documentupload">Documenten uploaden</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label for="image" class="col-lg-4 col-form-label text-lg-right">Document</label>
                                                                
                                                                <div class="col-lg-7 text-left">
                                                                    <label class="btn btn-primary" id="ex-iput-label" for="examimations">
                                                                        <input name="exam" id="examimations" type="file" style="display:none" 
                                                                        onchange="$('#exam-file-info').html(this.files[0].name)">
                                                                        Kies bestand
                                                                    </label>
                                                                    <span class='label label-info' id="exam-file-info"></span>
                                                                </div>
                                                            </div>
                                
                                                            <div class="form-group row">
                                                                <label for="image" class="col-lg-4 col-form-label text-lg-right">Categorie</label>
                                                                
                                                                <div class="col-lg-7">
                                                                    <select name="exam_category" class="form-control" id="category" required>
                                                                        <option value="internal">Inwendig onderzoek</option>
                                                                        <option value="external">Uitwendig onderzoek</option>
                                                                        <option value="water">Waterdruktest</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-lg-4 col-form-label text-lg-right">Datum Onderzoek</label>
                                                                <div class="col-lg-7 text-left">
                                                                    <input type="datetime-local" name="test_date" class="form-control" id="staticEmail">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary" onclick="return confirmation('exam-add-{{$data[0]->id}}')">
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
                    <table class="table table-striped table-hover table-responsive">
                        <tbody>
                            @forelse ($data[0]->vehicle_file->where('type', 'exam') as $item)
                                <tr>
                                    @switch($item->category)
                                        @case('internal')
                                            <td class="p-1"><b>Inwendig onderzoek</b>: </td>
                                            <td class="p-1 text-left"><a href="{{asset($item->url)}}">{{$item->name}}</a></td>
                                            <td class="p-1 m-1 badge badge-pill {{$internal}} text-left">{{$item->test_date}}</td>
                                            @break
                                        @case('external')
                                            <td class="p-1"><b>Uitwendig onderzoek</b>: </td> 
                                            <td class="p-1 text-left"><a href="{{asset($item->url)}}">{{$item->name}}</a></td>
                                            <td class="p-1 m-1 badge badge-pill {{$external}} text-left">{{$item->test_date}}</td>
                                            @break
                                        @case('water')
                                            <td class="p-1"><b>Waterdrukproef</b>: </td> 
                                            <td class="p-1 text-left"><a href="{{asset($item->url)}}">{{$item->name}}</a></td>
                                            <td class="p-1 m-1 badge badge-pill {{$water}} text-left">{{$item->test_date}}</td>
                                            @break
                                    @endswitch
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center">Geen keuringen beschikbaar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection