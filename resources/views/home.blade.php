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
                <div class="card-header">{{ __('Menu') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="{{route('ris')}}">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/ris.png')}}">
                                    <div class="py-3 card-body bg-secondary">ReizigersInformatie</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="{{route('map')}}">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/map.png')}}">
                                    <div class="py-3 card-body bg-secondary">Train Map</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="/filemanager" target="popup">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/scanner.png')}}">
                                    <div class="py-3 card-body bg-secondary">Mijn bestanden</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="https://www.scm-team.be/">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/scmteam.png')}}">
                                    <div class="py-3 card-body bg-secondary">SCM-Team</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="https://login.one.com/cp/">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/one.png')}}">
                                    <div class="py-3 card-body bg-secondary">One.com</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="https://www.stoomtreinmaldegem.be/nl">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/stme.png')}}">
                                    <div class="py-3 card-body bg-secondary">Stoomtrein Maldegem</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="https://academy.scm-team.be">
                                <div class="card">
                                    <img class="card-img-top"  src="{{('./images/main/academy.png')}}">
                                    <div class="py-3 card-body bg-secondary">Academy</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="https://forms.scm-team.be">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/forms.png')}}">
                                    <div class="py-3 card-body bg-secondary">SCM-Formulieren</div>
                                </div>
                            </a>
                            <a class="text-decoration-none my-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" href="https://login.mailchimp.com/">
                                <div class="card">
                                    <img class="card-img-top"  src="{{asset('./images/main/mailchimp.png')}}">
                                    <div class="py-3 card-body bg-secondary">Mailchimp</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Treinen') }}</div>
                <div class="list-group">
                    @foreach ($data as $item)
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action flex-column">
                                <div class="d-flex justify-content-between">
                                    <div class="float-left text-left">
                                        <h4 class="mb-1 text-left">{{$item->first_text}} <br>{{$item->second_text}}</h4>
                                    </div>
                                    <div class="float-right text-right">
                                        <small class="muted">{{Carbon::parse($item->time)->diff(\Carbon\Carbon::now())->format('over %h uur en %i minuten')}}</small><br>
                                        <h5><span class="badge badge-info"><my-icon style="color: white" v-bind:icon_index="{{$item->icon_index}}"></my-icon></span></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
