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
                                <select id="type" class="form-control" name="type">
                                    <option value="normaal">
                                        Normaalspoor
                                    </option>
                                    <option value="smal">
                                        Smalspoor
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Categorie</label>
                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category">
                                    <option value="motorwagen">
                                        Motorwagen
                                    </option>
                                    <option value="diesellocomotief">
                                        Diesellocomotief
                                    </option>
                                    <option value="stoomlocomotief">
                                        Stoomlocomotief
                                    </option>
                                    <option value="werfvoertuig">
                                        Werfvoertuig
                                    </option>
                                    <option value="rijtuig">
                                        Rijtuig
                                    </option>
                                    <option value="wagen">
                                        Wagen
                                    </option>
                                    <option value="Andere">
                                        Andere
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Naam Voertuig</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">Toestand</label>
                            <div class="col-md-6">
                                <select id="state" class="form-control" name="state">
                                    <option value="in_dienst">In Dienst
                                    </option>
                                    <option value="buiten_dienst">Buiten Dienst
                                    </option>
                                    <option value="in_reserve">In Reserve
                                    </option>
                                    <option value="onder_voorwaarde">Onder Voorwaarde
                                    </option>
                                    <option value="andere">Andere
                                    </option>
                                </select>
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