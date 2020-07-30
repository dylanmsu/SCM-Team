@extends('layouts.app')

@section('title', 'home')

@section('content')

@php
    use Carbon\Carbon;
    Carbon::setLocale('nl');
@endphp

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('home')}}">Home</a></li>
        </ol>
    </nav>
    
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row text-center">
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="{{route('ris')}}">
                                    <img class="card-img-top" src="{{asset('./images/main/ris.png')}}">
                                    <div class="py-3 card-footer">ReizigersInformatie</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="{{route('map')}}">
                                    <img class="card-img-top" src="{{asset('./images/main/map.png')}}">
                                    <div class="py-3 card-footer">Train Map</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="/filemanager" target="popup">
                                    <img class="card-img-top" src="{{asset('./images/main/scanner.png')}}">
                                    <div class="py-3 card-footer">Mijn bestanden</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="https://www.scm-team.be/">
                                    <img class="card-img-top" src="{{asset('./images/main/scmteam.png')}}">
                                    <div class="py-3 card-footer">SCM-Team</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="https://login.one.com/cp/">
                                    <img class="card-img-top" src="{{asset('./images/main/one.png')}}">
                                    <div class="py-3 card-footer">One.com</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="https://www.stoomtreinmaldegem.be/nl">
                                    <img class="card-img-top" src="{{asset('./images/main/stme.png')}}">
                                    <div class="py-3 card-footer">Stoomtrein Maldegem</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="https://academy.scm-team.be">
                                    <img class="card-img-top" src="{{('./images/main/academy.png')}}">
                                    <div class="py-3 card-footer">Academy</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="https://forms.scm-team.be">
                                    <img class="card-img-top" src="{{asset('./images/main/forms.png')}}">
                                    <div class="py-3 card-footer">SCM-Formulieren</div>
                                </a>
                            </div>
                            <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                <a class="card my-card text-decoration-none" href="https://login.mailchimp.com/">
                                    <img class="card-img-top" src="{{asset('./images/main/mailchimp.png')}}">
                                    <div class="py-3 card-footer">Mailchimp</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Treinen') }}</div>
                <div class="list-group">
                    @if (isset($data))
                        @foreach ($data as $item)
                            <div class="list-group">
                                <a href="#" class="py-2 list-group-item list-group-item-action flex-column">
                                    <div class="d-flex justify-content-between">
                                        <div class="float-left text-left">
                                            <h4 class="mb-1 text-left">{{$item->first_text}} <br>{{$item->second_text}}</h4>
                                        </div>
                                        <div class="float-right text-right">
                                            <small class="text-muted">{{Carbon::parse($item->time)->diff(\Carbon\Carbon::now())->format('over %h uur en %i minuten')}}</small><br>
                                            <h5><span class="badge badge-info"><my-icon style="color: white" v-bind:icon_index="{{$item->icon_index}}"></my-icon></span></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="list-group">
                            <a href="#" class="py-2 list-group-item list-group-item-action flex-column">
                                <div class="d-flex justify-content-between">
                                    <div class="float-left text-left">
                                        <h4 class="mb-1 text-center">geen treinen in de komende 24u</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
