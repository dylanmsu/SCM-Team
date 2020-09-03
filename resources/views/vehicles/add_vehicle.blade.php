@extends('layouts.app')
@section('title', 'Rollend Materieel toevoegen')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vehicles')}}">Rollend Matrieel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Toevoegen</li>
        </ol>
    </nav>

    @if(session('success') != "")
    <div>
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>
    @endif

    @if(session('error') != "")
    <div>
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Toevoegen</div>

                <div class="card-body">
                    @if ($action ?? '' == 'edit')
                        <form method="post" enctype="multipart/form-data" action="/rollend/bijwerken/{{$vehicle->id ?? ''}}">
                    @else
                        <form method="post" enctype="multipart/form-data" action="{{route('add_vehicle')}}">
                    @endif
                        @csrf
                        <div class="form-group row">
                            <label for="type" class="col-lg-4 col-form-label text-lg-right">Type</label>

                            <div class="col-lg-6">
                                <select id="type" class="form-control" name="type" required>
                                    <option value="normaal" {{ $vehicle->type ?? '' == 'normaal' ? 'selected' : '' }}>
                                        Normaalspoor
                                    </option>
                                    <option value="smal" {{ $vehicle->type ?? '' == 'smal' ? 'selected' : '' }}>
                                        Smalspoor
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-lg-4 col-form-label text-lg-right">Categorie</label>

                            <div class="col-lg-6">
                                <select id="category" class="form-control" name="category" required>
                                    <option value="motorwagen" {{ $vehicle->category ?? '' == 'motorwagen' ? 'selected' : '' }}>
                                        Motorwagen
                                    </option>
                                    <option value="diesellocomotief" {{ $vehicle->category ?? '' == 'diesellocomotief' ? 'selected' : '' }}>
                                        Diesellocomotief
                                    </option>
                                    <option value="stoomlocomotief" {{ $vehicle->category ?? '' == 'stoomlocomotief' ? 'selected' : '' }}>
                                        Stoomlocomotief
                                    </option>
                                    <option value="werfvoertuig" {{ $vehicle->category ?? '' == 'werfvoertuig' ? 'selected' : '' }}>
                                        Werfvoertuig
                                    </option>
                                    <option value="rijtuig" {{ $vehicle->category ?? '' == 'rijtuig' ? 'selected' : '' }}>
                                        Rijtuig
                                    </option>
                                    <option value="wagen" {{ $vehicle->category ?? '' == 'wagen' ? 'selected' : '' }}>
                                        Wagen
                                    </option>
                                    <option value="andere" {{ $vehicle->category ?? '' == 'andere' ? 'selected' : '' }}>
                                        Andere
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-lg-4 col-form-label text-lg-right">Naam Voertuig</label>
                            
                            <div class="col-lg-6">
                                <input id="name" type="text" value="{{ $vehicle->name ?? '' }}" class="form-control" name="name" required autocomplete="train-name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-lg-4 col-form-label text-lg-right">Status</label>

                            @if ($action ?? '' == 'edit')
                                <div class="col-lg-6 input-group">
                                    <select id="state" class="form-control" name="state">
                                        <option value="in_dienst" {{ $vehicle->state ?? '' == 'in_dienst' ? 'selected' : '' }}>
                                            In Dienst
                                        </option>
                                        <option value="buiten_dienst" {{ $vehicle->state ?? '' == 'buiten_dienst' ? 'selected' : '' }}>
                                            Buiten Dienst
                                        </option>
                                        <option value="in_reserve" {{ $vehicle->state ?? '' == 'in_reserve' ? 'selected' : '' }}>
                                            In Reserve
                                        </option>
                                        <option value="onder_voorwaarde" {{ $vehicle->state ?? '' == 'onder_voorwaarde' ? 'selected' : '' }}>
                                            Voorwaarde
                                        </option>
                                        <option value="andere" {{ $vehicle->state ?? '' == 'andere' ? 'selected' : '' }}>
                                            Andere
                                        </option>
                                    </select>
                                </div> 
                            @else
                                <div class="col-lg-6 input-group">
                                    <div class="input-group-prepend">
                                        <select id="state" class="input-group-text form-control" name="state">
                                            <option value="in_dienst" {{ $vehicle->state ?? '' == 'in_dienst' ? 'selected' : '' }}>
                                                In Dienst
                                            </option>
                                            <option value="buiten_dienst" {{ $vehicle->state ?? '' == 'buiten_dienst' ? 'selected' : '' }}>
                                                Buiten Dienst
                                            </option>
                                            <option value="in_reserve" {{ $vehicle->state ?? '' == 'in_reserve' ? 'selected' : '' }}>
                                                In Reserve
                                            </option>
                                            <option value="onder_voorwaarde" {{ $vehicle->state ?? '' == 'onder_voorwaarde' ? 'selected' : '' }}>
                                                Voorwaarde
                                            </option>
                                            <option value="andere" {{ $vehicle->state ?? '' == 'andere' ? 'selected' : '' }}>
                                                Andere
                                            </option>
                                        </select>
                                    </div>
                                    <input id="name" type="text" placeholder="Commentaar" class="form-control" name="comment" autocomplete="comment">
                                </div>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-lg-4 col-form-label text-lg-right">Afbeeldingen trein</label>
                            
                            <div class="col-lg-6">
                                <input id="image" type="file" class="form-control-file" name="image[]" multiple>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-lg-4 col-form-label text-lg-right">Eigenschappen</label>
                            
                            <div class="col-lg-6">
                                <div class="input_fields_wrap">
                                    <div class="input-group">
                                        <input placeholder="Eigenschap" class="form-control col" type="text" name="prop[]"/><input placeholder="Waarde" class="col form-control" type="text" name="val[]"/>
                                        <div class="input-group-prepend"><div class="btn btn-primary add_field_button">+</div></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Toevoegen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection