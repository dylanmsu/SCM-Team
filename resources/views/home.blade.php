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

      @php
        $home_cards = array(
            array('color' => '#DFE6E9', 'icon' => './images/icons/calendar-check.svg',   'name' => 'Splitflap Boards',    'target' => "",        'link' => route('ris')),
            array('color' => '#87DE87', 'icon' => './images/icons/person.svg',           'name' => 'Leden',               'target' => "",        'link' => route('members')),
            array('color' => '#FFEAA7', 'icon' => './images/icons/files.svg',            'name' => 'Mijn bestanden',      'target' => "_blank",  'link' => "/filemanager"),
            array('color' => '#74B9FF', 'icon' => './images/icons/map.svg',              'name' => 'Train Map',           'target' => "",        'link' => route('map')),
            array('color' => '#FF9955', 'icon' => './images/icons/link.svg',             'name' => 'Links',               'target' => "",        'link' => route('links')),
            array('color' => '#7FFFD4', 'icon' => './images/icons/truck.svg',            'name' => 'Rollend Matrieel',    'target' => "",        'link' => route('rolling')),
        );
      @endphp

      <!-- left side -->
      <div class="col-md-8">

         <div class="card">
            <div class="card-header">Menu</div>
            <div class="card-body">
               <div class="container">
                  <div class="row text-center">

                     <!-- loop through the array above to create the cards -->
                     @foreach ($home_cards as $card)
                        <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                           <a class="card my-card text-decoration-none" href="{{ $card['link'] }}" target="{{ $card['target'] }}">

                                <img style="background-color: {{$card['color']}}" class="card-img-top" src="{{ asset('./images/main/blank.png') }}">
                                <div class="card-img-overlay">
                                    <img class="my-1" width="60%" src="{{asset($card['icon'])}}" alt="">
                                </div>

                                <div class="py-3 card-footer">{{ $card['name'] }}</div>
                           </a>
                        </div>
                     @endforeach

                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-4">
         <div class="card">
            <div class="card-header">Treinen</div>
            <div class="list-group">
               @if (isset($data))

                  <!-- loop through the data that is returned from 'app/http/homeController.php' -->
                  @foreach ($data as $item)
                     <div class="list-group">
                        <a href="#" class="py-2 list-group-item list-group-item-action flex-column">
                           <div class="d-flex justify-content-between">
                              <div class="float-left text-left">
                                 <h4 class="mb-1 text-left">{{ $item->first_text }} <br> {{ $item->second_text }}</h4>
                              </div>
                              <div class="float-right text-right">
                                 <small class="text-muted">{{ Carbon::parse($item->time)->diff(\Carbon\Carbon::now())->format('over %h uur en %i minuten') }}</small><br>
                                 <h5>
                                    <span class="badge badge-info">
                                       <my-icon style="color: white" v-bind:icon_index="{{ $item->icon_index }}"></my-icon>
                                    </span>
                                 </h5>
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
                              <h4 class="mb-1 text-center">Geen treinen in de komende 24u</h4>
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
