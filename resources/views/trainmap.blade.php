@extends('layouts.app')

@section('title', 'Train Map')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">TrainMap</li>
        </ol>
    </nav>
    
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>
                    <div class="card-body">
                        <div id="card-container">
                            <a id="my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerHLV&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                                <img src="{{asset('./images/map/hlv.png')}}">
                                <h3>Stoomlocomotief</h3>
                            </a>
                            <a id="my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerMW&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                                <img src="{{asset('./images/map/mw.png')}}">
                                <h3>Motorwagen</h3>
                            </a>
                            <a id="my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerHLR&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                                <img src="{{asset('./images/map/hld.png')}}">
                                <h3>Rangeerlocomotief</h3>
                            </a>
                            <a id="my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerSS&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                                <img src="{{asset('./images/map/sms.png')}}">
                                <h3>Smalspoor</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection