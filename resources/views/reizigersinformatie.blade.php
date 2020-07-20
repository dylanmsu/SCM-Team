@extends('layouts.app')

@section('title', 'ReizigersInformatie')

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
                <a id="my-card" href="/ris/board-info">
                    <img src="{{asset('./images/split/content.png')}}">
                    <h3>Board Status</h3>
                </a>
                <a id="my-card" href="/ris/board-setup">
                    <img src="{{asset('./images/split/status.png')}}">
                    <h3>Board Setup</h3>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection