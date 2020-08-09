@extends('layouts.app')

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
                            <label for="category" class="col-md-4 col-form-label text-md-right">Categorie</label>
                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category">
                                    <option value="motorwagen">
                                        motorwagen
                                    </option>
                                    <option value="diesellocomotief">
                                        diesellocomotief
                                    </option>
                                    <option value="stoomlocomotief">
                                        stoomlocomotief
                                    </option>
                                    <option value="werfvoertuig">
                                        werfvoertuig
                                    </option>
                                    <option value="rijtuig">
                                        rijtuig
                                    </option>
                                    <option value="wagen">
                                        wagen
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
                            <label for="state" class="col-md-4 col-form-label text-md-right">Huidige staat</label>
                            <div class="col-md-6">
                                <select id="state" class="form-control" name="state">
                                    <option value="in_dienst">
                                        <span class="status text-success">&bull;</span>
                                        In Dienst
                                    </option>
                                    <option value="buiten_dienst">
                                        <span class="status text-danger">&bull;</span>
                                        Buiten Dienst
                                    </option>
                                    <option value="in_reserve">
                                        <span class="status text-primary">&bull;</span>
                                        In Reserve
                                    </option>
                                    <option value="onder_voorwaarde">
                                        <span class="status text-warning">&bull;</span>
                                        Onder Voorwaarde
                                    </option>
                                    <option value="andere">
                                        <span class="status text-secondary">&bull;</span>
                                        Andere
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">Commentaar</label>

                            <div class="col-md-6">
                                <textarea id="comment" type="textbox" class="form-control" name="comment" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">type</label>

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