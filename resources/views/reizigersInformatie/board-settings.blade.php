@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('ris')}}">ReizigersInformatie</a></li>
            <li class="breadcrumb-item active" aria-current="page">Instellingen</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-left">
                            <div class="h4 my-1">Instellingen</div> 
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <a href="{{route('board-graphs')}}" class="ml-2 btn btn-primary"> <i class="far fa-chart-bar"></i> Grafieken</a>
                        </div>
                    </div>
                </div>
    
                <div class="card-body">
                    <form method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Licht helderheid</label>
        
                            <div class="col-md-6">
                                <div class="btn-group btn-group-toggle" id="name" data-toggle="buttons">
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
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">RGB mode</label>
        
                            <div class="col-md-6">
                                <select name="icon_index" class="form-control">
                                    <option value="0">Uit</option>
                                    <option value="1">Aan</option>
                                    <option value="2">Pulse</option>
                                    <option value="3">Regenboog</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">RGB kleur</label>
        
                            <div class="col-md-6">
                                <input class="form-control" type="color" name="color" value="#ff0000">
                            </div>
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
        </div>
    </div>
</div>
@endsection