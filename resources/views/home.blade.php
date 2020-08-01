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
            array('img' => './images/main/ris.png',       'name' => 'Splitflap Boards',    'target' => "",        'link' => route('ris')),
            array('img' => './images/main/map.png',       'name' => 'Train Map',           'target' => "",        'link' => route('map')),
            array('img' => './images/main/scanner.png',   'name' => 'Mijn bestanden',      'target' => "_blank",  'link' => "/filemanager"),
            array('img' => './images/main/scmteam.png',   'name' => 'SCM-Team',            'target' => "",        'link' => "https://www.scm-team.be"),
            array('img' => './images/main/one.png',       'name' => 'One.com',             'target' => "",        'link' => "https://login.one.com/cp"),
            array('img' => './images/main/stme.png',      'name' => 'Stoomtrein Maldegem', 'target' => "",        'link' => "https://www.stoomtreinmaldegem.be/nl"),
            array('img' => './images/main/academy.png',   'name' => 'Academy',             'target' => "",        'link' => "https://academy.scm-team.be"),
            array('img' => './images/main/forms.png',     'name' => 'SCM-Formulieren',     'target' => "",        'link' => "https://forms.scm-team.be"),
            array('img' => './images/main/mailchimp.png', 'name' => 'Mailchimp',           'target' => "",        'link' => "https://login.mailchimp.com/")
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
                              <img class="card-img-top" src="{{ asset($card['img']) }}">
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
