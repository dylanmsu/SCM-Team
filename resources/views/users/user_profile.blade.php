@extends('layouts.app')

@section('title', 'Links')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profiel</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="h4 my-1">Profiel</div>
                    </div>
        
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td class="p-1 text-right"><b>Voornaam</b>: </td><td class="p-1 text-left">{{Auth::user()->first_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Familienaam</b>: </td><td class="p-1 text-left">{{Auth::user()->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Email adres</b>: </td><td class="p-1 text-left">{{Auth::user()->email}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Gebruikersnaam</b>: </td><td class="p-1 text-left">{{Auth::user()->username}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Admin ID</b>: </td><td class="p-1 text-left">{{Auth::user()->role_id}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Geboortedatum</b>: </td><td class="p-1 text-left">{{Auth::user()->birth_day}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Geboorteplaats</b>: </td><td class="p-1 text-left">{{Auth::user()->birth_place}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Adres</b>: </td><td class="p-1 text-left">{{Auth::user()->address}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Postcode</b>: </td><td class="p-1 text-left">{{Auth::user()->postal_code}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Woonplaats</b>: </td><td class="p-1 text-left">{{Auth::user()->residence}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Provincie</b>: </td><td class="p-1 text-left">{{Auth::user()->province}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>country</b>: </td><td class="p-1 text-left">{{Auth::user()->country}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>GSM nummer</b>: </td><td class="p-1 text-left">{{Auth::user()->mobile_phone}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Vaste telefoon</b>: </td><td class="p-1 text-left">{{Auth::user()->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 text-right"><b>Naam ouder</b>: </td><td class="p-1 text-left">{{Auth::user()->name_parent}}</td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection