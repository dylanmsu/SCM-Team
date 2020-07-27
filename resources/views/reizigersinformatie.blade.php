@extends('layouts.app')

@section('title', 'ReizigersInformatie')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">ReizigersInformatie</li>
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
                    <a id="my-card" href="{{route('ris/board-info')}}">
                        <img src="{{asset('./images/split/content.png')}}">
                        <h3>Board Status</h3>
                    </a>
                    <a id="my-card" href="{{route('ris/board-setup')}}">
                        <img src="{{asset('./images/split/status.png')}}">
                        <h3>Board Setup</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
