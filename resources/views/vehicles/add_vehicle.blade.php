@extends('layouts.app')
@section('title', 'Rollend Materieel toevoegen')
@section('content')
<div class="container" ng-app="">
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

    <div class="justify-content-center">
        @if ($action ?? '' == 'edit')
        <form method="post" enctype="multipart/form-data" action="/rollend/bijwerken/{{$vehicle->id ?? ''}}">
        @else
        <form method="post" enctype="multipart/form-data" action="{{route('add_vehicle')}}">
        @endif
            @csrf
            <div class="card mb-1">

                <div class="card-header">
                    <h2>Trein Toevoegen</h2> 
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="name">Naam Voertuig</label>
                                <input id="name" type="text" value="{{ $vehicle->name ?? '' }}" class="form-control" name="name" required autocomplete="train-name">
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="type">Type</label>
                                <select id="type" class="form-control" name="type" required>
                                    <option value="normaal" @if(($vehicle->type ?? 'normaal') == 'normaal')  selected="selected" @endif>
                                        Normaalspoor
                                    </option>
                                    <option value="smal" @if(($vehicle->type ?? 'normaal') == 'smal')  selected="selected" @endif>
                                        Smalspoor
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="category">Categorie</label>
                                <select id="category" class="form-control" name="category" ng-model="category" required>
                                    <option value="stoomlocomotief" @if(($vehicle->category ?? 'andere') == 'stoomlocomotief')  selected="selected" @endif>
                                        Stoomlocomotief
                                    </option>
                                    <option value="diesellocomotief" @if(($vehicle->category ?? 'andere') == 'diesellocomotief')  selected="selected" @endif>
                                        Diesellocomotief
                                    </option>
                                    <option value="motorwagen" @if(($vehicle->category ?? 'andere') == 'motorwagen')  selected="selected" @endif>
                                        Motorwagen
                                    </option>
                                    <option value="rijtuig" @if(($vehicle->category ?? 'andere') == 'rijtuig')  selected="selected" @endif>
                                        Rijtuig
                                    </option>
                                    <option value="werfvoertuig" @if(($vehicle->category ?? 'andere') == 'werfvoertuig')  selected="selected" @endif>
                                        Werfvoertuig
                                    </option>
                                    <option value="andere" @if(($vehicle->category ?? 'andere') == 'andere')  selected="selected" @endif>
                                        Andere
                                    </option>
                                </select>
                            </div>

                            @if (($vehicle ?? ''))
                                <div class="col-lg-6 input-group">
                                <label for="state">Status</label>
                                    <select id="state" class="form-control" name="state">
                                        <option value="in_dienst"  @if(($vehicle->state ?? 'andere') == 'in_dienst')  selected="selected" @endif>
                                            In Dienst
                                        </option>
                                        <option value="buiten_dienst"  @if(($vehicle->state ?? 'andere') == 'buiten_dienst')  selected="selected" @endif>
                                            Buiten Dienst
                                        </option>
                                        <option value="in_reserve"  @if(($vehicle->state ?? 'andere') == 'in_reserve')  selected="selected" @endif>
                                            In Reserve
                                        </option>
                                        <option value="onder_voorwaarde" @if(($vehicle->state ?? 'andere') == 'onder_voorwaarde')  selected="selected" @endif>
                                            Voorwaarde
                                        </option>
                                        <option value="andere" @if(($vehicle->state ?? 'andere') == 'andere')  selected="selected" @endif>
                                            Andere
                                        </option>
                                    </select>
                                </div> 
                            @else
                            
                                <div class="col-lg-6">
                                    <label for="state">Status</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select class="input-group-text form-control" name="state">
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
                                        <input id="state" type="text" placeholder="Commentaar" class="form-control" name="comment" autocomplete="comment">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if (!($action ?? '' == 'edit'))

            <div class="card mb-1">
                <div class="card-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-lg-6" ng-switch on="category">
                                <label for="description">Wielen en assen</label>
                                <div class="mb-1 input-group">
                                    <input value="Wieldiameter" class="form-control col" type="text" name="prop2[]" readonly/>
                                    <input placeholder="Waarde" class="col form-control" type="text" name="val2[]" required/>
                                </div>
                                <div class="mb-1 input-group">
                                    <input value="Aantal assen" class="form-control col" type="text" name="prop2[]" readonly/>
                                    <input placeholder="Waarde" class="col form-control" type="text" name="val2[]" required/>
                                </div>
                                <div class="mb-1 input-group">
                                    <input value="Infrabel Uitzondering" class="form-control col" type="text" name="prop2[]" readonly/>
                                    <input placeholder="Waarde" class="col form-control" type="text" name="val2[]" required/>
                                </div>
                                <div class="mb-1 input-group">
                                    <input value="Kleinste as-afstand" class="form-control col" type="text" name="prop2[]" readonly/>
                                    <input placeholder="Waarde" class="col form-control" type="text" name="val2[]" required/>
                                </div>
                                <div class="mb-1 input-group">
                                    <input value="Grootste as-afstand" class="form-control col" type="text" name="prop2[]" readonly/>
                                    <input placeholder="Waarde" class="col form-control" type="text" name="val2[]" required/>
                                </div>
                                <div class="mb-1 input-group">
                                    <input value="Spoorbreedte" class="form-control col" type="text" name="prop2[]" readonly/>
                                    <input placeholder="Waarde" class="col form-control" type="text" name="val2[]" required/>
                                </div>
                            </div>
                            
                            <div class="col-lg-6" ng-switch on="category">
                                
                            <label for="description">Eigenschappen</label>

                                <div ng-switch-when="motorwagen" >
                                    <div class="mb-1 input-group">
                                        <input value="As-indeling" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Boogstraal" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Snelheidsaanduiding" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Remregime" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Zitplaatsen" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Motor" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Vermogen" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Overbrenging" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Toerental" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Brandstoftanks" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                </div>

                                <div ng-switch-when="diesellocomotief" >
                                    <div class="mb-1 input-group">
                                        <input value="As-indeling" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Min. Boogstraal" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Snelheidsaanduiding" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Remregime" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Vermogen" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Motor" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Overbrenging" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Toerental" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Brandstoftanks" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                </div>

                                <div ng-switch-when="stoomlocomotief" >
                                    <div class="mb-1 input-group">
                                        <input value="As-indeling" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Keteldruk" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Snelheidsaanduiding" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Remregime" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Koleninhoud" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Watertankinhoud" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                </div>

                                <div ng-switch-when="rijtuig" >
                                    <div class="mb-1 input-group">
                                        <input value="Min. Boogstraal" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Zitplaatsen" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Intercirculatie" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Eindseinen" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Remverdeler" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                </div>

                                <div ng-switch-when="werfvoertuig" >
                                    <div class="mb-1 input-group">
                                        <input value="Max. Hoogte" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Breedte" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Max. Laadoppervlakte" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Draag-vermogen" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Eindseinen" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                    <div class="mb-1 input-group">
                                        <input value="Remverdeler" class="form-control col" type="text" name="prop[]" readonly/>
                                        <input placeholder="Waarde" class="col form-control" type="text" name="val[]" required/>
                                    </div>
                                </div>
                                
                                <div class="input_fields_wrap" ng-switch-default>
                                    <div class="mb-1 input-group">
                                        <input placeholder="Eigenschap" class="form-control col" type="text" name="prop[]" required/>
                                        <input placeholder="Waarde" class="form-control col" type="text" name="val[]" required/>
                                        <div id="addbtn" class="col-1 btn btn-primary add_field_button">+</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                            
            <div class="card mb-1">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="image" class="col-lg-4 col-form-label text-lg-right">Afbeeldingen trein</label>
                        
                        <div class="col-lg-6">
                            <label class="btn btn-primary" id="image" for="image-train">
                                <input name="image[]" id="image-train" type="file" style="display:none" 
                                onchange="$('#vehicle-image').html(this.files[0].name)" multiple>
                                Kies bestand
                            </label>
                            <span class='label label-info' id="vehicle-image"></span>
                        </div>
                    </div>
                </div>
            </div>

                            
            <div class="card mb-1">
                <div class="card-body">
                    <div class="form-group container row">
                        <div class="col-lg-4">
                            <br>
                            <p>Inwendig onderzoek:</p>
                        </div>
                    
                        
                        <div class="col-lg-4">
                            <label for="int-examimations" class="">Document</label><br>
                            <label class="btn btn-primary" id="ex-iput-label" for="int-examimations">
                                <input name="external" id="int-examimations" type="file" style="display:none" 
                                onchange="$('#int-exam').html(this.files[0].name)">
                                Kies bestand
                            </label>
                            <span class='label label-info' id="int-exam"></span>
                        </div>
                    
                        <div class="col-lg-4">
                            <label for="int-date" class="">Datum Onderzoek</label>
                            <input type="datetime-local" name="date-internal" class="form-control" id="staticEmail">
                        </div>
                    </div>


                    
                    <div class="form-group container row">
                        <div class="col-lg-4">
                            <br>
                            <p>Uitwendig onderzoek:</p>
                        </div>
                    
                        
                        <div class="col-lg-4 text-left">
                            <label for="image">Document</label><br>
                            <label class="btn btn-primary" id="in-iput-label" for="ext-examimations">
                                <input name="internal" id="ext-examimations" type="file" style="display:none" 
                                onchange="$('#ext-exam').html(this.files[0].name)">
                                Kies bestand
                            </label>
                            <span class='label label-info' id="ext-exam"></span>
                        </div>
                    
                        <div class="col-lg-4 text-left">
                            <label for="staticEmail">Datum Onderzoek</label>
                            <input type="datetime-local" name="date-external" class="form-control" id="staticEmail">
                        </div>
                    </div>



                    <div class="form-group container row">
                        <div class="col-lg-4">
                            <br>
                            <p>Waterdruktest:</p>
                        </div>
                    
                        
                        <div class="col-lg-4 text-left">
                            <label for="water-examimations">Document</label><br>
                            <label class="btn btn-primary" id="water-label" for="water-examimations">
                                <input name="water" id="water-examimations" type="file" style="display:none" 
                                onchange="$('#water-exam').html(this.files[0].name)">
                                Kies bestand
                            </label>
                            <span class='label label-info' id="water-exam"></span>
                        </div>
                    
                        <div class="col-lg-4 text-left">
                            <label for="staticEmail">Datum Onderzoek</label>
                            <input type="datetime-local" name="date-water" class="form-control" id="staticEmail">
                        </div>
                    </div>
                </div>
            </div>
            @endif

                            
            <div class="card mb-5">
                <div class="card-body">
                    <div class="form-group row mb-0 justify-content-center">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                @if ($action ?? '' == 'edit')
                                    Bijwerken
                                @else
                                    Toevoegen
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection