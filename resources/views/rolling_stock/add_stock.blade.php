@extends('layouts.app')
@section('title', 'Rollend Materieel toevoegen')
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('rolling')}}">Rollend Matrieel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Toevoegen</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Toevoegen</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="type" required>
                                    <option value="normaal" {{ old('type') == 'normaal' ? 'selected' : '' }}>
                                        Normaalspoor
                                    </option>
                                    <option value="smal" {{ old('type') == 'smal' ? 'selected' : '' }}>
                                        Smalspoor
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Categorie</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category" required>
                                    <option value="motorwagen" {{ old('category') == 'normaal' ? 'selected' : '' }}>
                                        Motorwagen
                                    </option>
                                    <option value="diesellocomotief" {{ old('category') == 'diesellocomotief' ? 'selected' : '' }}>
                                        Diesellocomotief
                                    </option>
                                    <option value="stoomlocomotief" {{ old('category') == 'stoomlocomotief' ? 'selected' : '' }}>
                                        Stoomlocomotief
                                    </option>
                                    <option value="werfvoertuig" {{ old('category') == 'werfvoertuig' ? 'selected' : '' }}>
                                        Werfvoertuig
                                    </option>
                                    <option value="rijtuig" {{ old('category') == 'rijtuig' ? 'selected' : '' }}>
                                        Rijtuig
                                    </option>
                                    <option value="wagen" {{ old('category') == 'wagen' ? 'selected' : '' }}>
                                        Wagen
                                    </option>
                                    <option value="Andere" {{ old('category') == 'Andere' ? 'selected' : '' }}>
                                        Andere
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Naam Voertuig</label>
                            
                            <div class="col-md-6">
                                <input id="name" type="text" value="{{ old('name') }}" class="form-control" name="name" required autocomplete="train-name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6 input-group">
                                <div class="input-group-prepend">
                                    <select id="state" class="input-group-text form-control" name="state">
                                        <option value="in_dienst" {{ old('state') == 'in_dienst' ? 'selected' : '' }}>
                                            In Dienst
                                        </option>
                                        <option value="buiten_dienst" {{ old('state') == 'buiten_dienst' ? 'selected' : '' }}>
                                            Buiten Dienst
                                        </option>
                                        <option value="in_reserve" {{ old('state') == 'in_reserve' ? 'selected' : '' }}>
                                            In Reserve
                                        </option>
                                        <option value="onder_voorwaarde" {{ old('state') == 'onder_voorwaarde' ? 'selected' : '' }}>
                                            Voorwaarde
                                        </option>
                                        <option value="andere" {{ old('state') == 'andere' ? 'selected' : '' }}>
                                            Andere
                                        </option>
                                    </select>
                                </div> 
                                <input id="name" type="text" placeholder="Commentaar" class="form-control" name="comment" autocomplete="comment">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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