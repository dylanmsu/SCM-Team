@extends('layouts.app')

@section('title', 'home')

@section('content')
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div id="card-container">
        <a id="my-card" href="/ris">
            <img src="{{asset('./images/main/ris.png')}}">
            <h3>ReizigersInformatie</h3>
        </a>
        <a id="my-card" href="/filemanager">
            <img src="{{asset('./images/main/scanner.png')}}">
            <h3>Mijn bestanden</h3>
        </a>
        <a id="my-card" href="/map">
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
@endsection
