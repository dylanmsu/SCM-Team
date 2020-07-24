@extends('layouts.app')

@section('title', 'Train Map')

@section('content')
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
        <a id="my-card" href="/ris/board-setup">
            <img src="{{asset('https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerSS&mapKey=ggsmap&units=metric&v=5.0.0.3284')}}">
            <h3>Smalspoor</h3>
        </a>
    </div>
</div>
@endsection