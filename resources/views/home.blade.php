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
                <div id="card-container">
                    <a id="my-card" href="{{route('ris')}}">
                        <img src="{{asset('./images/main/ris.png')}}">
                        <h3>ReizigersInformatie</h3>
                    </a>
                    <a id="my-card" href="/filemanager" target="popup">
                        <img src="{{asset('./images/main/scanner.png')}}">
                        <h3>Mijn bestanden</h3>
                    </a>
                    <a id="my-card" href="{{route('map')}}">
                        <img src="{{asset('./images/main/map.png')}}">
                        <h3>TrainMap</h3>
                    </a>
                    <a id="my-card" href="https://www.scm-team.be/">
                        <img src="{{asset('./images/main/scmteam.png')}}">
                        <h3>SCM-Team</h3>
                    </a>
                    <a id="my-card" href="https://login.one.com/cp/">
                        <img src="{{asset('./images/main/one.png')}}">
                        <h3>One.com</h3>
                    </a>
                    <a id="my-card" href="https://www.stoomtreinmaldegem.be/nl">
                        <img src="{{asset('./images/main/stme.png')}}">
                        <h3>Stoomtrein Maldegem</h3>
                    </a>
                    <a id="my-card" href="https://academy.scm-team.be">
                        <img src="{{('./images/main/academy.png')}}">
                        <h3>Academy</h3>
                    </a>
                    <a id="my-card" href="https://forms.scm-team.be">
                        <img src="{{asset('./images/main/forms.png')}}">
                        <h3>SCM-Formulieren</h3>
                    </a>
                    <a id="my-card" href="https://login.mailchimp.com/">
                        <img src="{{asset('./images/main/mailchimp.png')}}">
                        <h3>Mailchimp</h3>
                    </a>
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
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><my-icon v-bind:icon_index="{{$item->icon_index}}"></my-icon></h5>
                            <small>{{Carbon::parse($item->time)->diff(\Carbon\Carbon::now())->format('over %h uur en %i minuten')}}</small>
                          </div>
                          <p class="mb-2">{{$item->first_text}} {{$item->second_text}}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
