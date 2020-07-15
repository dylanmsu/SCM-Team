@extends('layouts.app')

@section('title', 'home')

@section('content')
<div class="">
    <div class="">

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <div id="card-container">
                <a id="my-card" href="/academy">
                    <img src="./images/main/academy.png">
                    <h3>Academy</h3>
                </a>
                <a id="my-card" href="/forms">
                    <img src="./images/main/forms.png">
                    <h3>SCM-Formulieren</h3>
                </a>
                <a id="my-card" href="/mailchimp">
                    <img src="./images/main/mailchimp.png">
                    <h3>Mailchimp</h3>
                </a>
                <a id="my-card" href="/map">
                    <img src="./images/main/map.png">
                    <h3>TrainMap</h3>
                </a>
                <a id="my-card" href="/">
                    <img src="./images/main/one.png">
                    <h3>One.com</h3>
                </a>
                <a id="my-card" href="/ris">
                    <img src="./images/main/ris.png">
                    <h3>ReizigersInformatie</h3>
                </a>
                <a id="my-card" href="/scanner">
                    <img src="./images/main/scanner.png">
                    <h3>Scanner</h3>
                </a>
                <a id="my-card" href="/scmteam">
                    <img src="./images/main/scmteam.png">
                    <h3>SCM-Team</h3>
                </a>
                <a id="my-card" href="/">
                    <img src="./images/main/stme.png">
                    <h3>Stoomtrein Maldegem</h3>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
