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
                  <div class="row text-center">
                     <div class="text-decoration-none my-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <a class="card my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerHLV&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                           <img class="card-img-top"  src="{{asset('./images/map/hlv.png')}}">
                           <div class="py-3 card-footer">Stoomlocomotief</div>
                        </a>
                     </div>
                     <div class="text-decoration-none my-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <a class="card my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerMW&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                           <img class="card-img-top"  src="{{asset('./images/map/mw.png')}}">
                           <div class="py-3 card-footer">Motorwagen</div>
                        </a>
                     </div>
                     <div class="text-decoration-none my-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <a class="card my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerHLR&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                           <img class="card-img-top"  src="{{asset('./images/map/hld.png')}}">
                           <div class="py-3 card-footer">Rangeerlocomotief</div>
                        </a>
                     </div>
                     <div class="text-decoration-none my-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <a class="card my-card" href="https://www.scm-server.be/track/Resources/ScriptPlugins/com.GpsGate/Publish/v3/single_nativemap.html?appId=5&viewId=6&userName=trackerSS&mapKey=ggsmap&units=metric&v=5.0.0.3284">
                           <img class="card-img-top"  src="{{asset('./images/map/sms.png')}}">
                           <div class="py-3 card-footer">Smalspoor</div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection