@extends('layouts.app')

@section('title', 'Home')

@section('content')

@php
   use Carbon\Carbon;
   Carbon::setLocale('nl');
@endphp

<div class="container">

    
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @php
            $home_cards = array(
                array('color' => '#b2bec3', 'icon' => 'calendar-minus',  'name' => 'Splitflap',        'target' => "",        'link' => route('ris')),
                array('color' => '#32ff7e', 'icon' => 'users',           'name' => 'Ledenbeheer',      'target' => "",        'link' => route('members')),
                array('color' => '#d63031', 'icon' => 'folder-open',     'name' => 'Mijn bestanden',   'target' => "_blank",  'link' => "/filemanager"),
                array('color' => '#0984e3', 'icon' => 'map',             'name' => 'Train maps',       'target' => "",        'link' => route('map')),
                array('color' => '#ffaf40', 'icon' => 'link',            'name' => 'Links',            'target' => "",        'link' => route('links')),
                array('color' => '#00cec9', 'icon' => 'subway',          'name' => 'Rollend matrieel', 'target' => "",        'link' => route('rolling')),
            );
        @endphp

        <!-- left side -->
        <div class="col-md-8">

            <div class="card mt-4">
                
                <div class="card-body">
                <div class="container">
                    <div class="row text-center">

                        <!-- loop through the array above to create the cards -->
                        @foreach ($home_cards as $card)
                            <div class="my-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                            <a class="card my-card text-decoration-none" href="{{ $card['link'] }}" target="{{ $card['target'] }}">

                                    <img style="background-color: {{$card['color']}}" class="card-img-top" src="{{ asset('./images/main/blank.png') }}">
                                    <div class="card-img-overlay pt-4">
                                        
                                    <i class="fas fa-{{$card['icon']}} fa-6x text-light"></i>
                                    
                                    </div>

                                    <div class="py-3 card-footer text-uppercase"><strong>{{ $card['name'] }}</strong></div>
                            </a>
                            </div>
                        @endforeach

                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mt-4">
                <div class="card-header text-center text-uppercase"><strong>Reizigersinformatie</strong></div>
                <div class="list-group">
                    @if (!$data->isEmpty())

                        <!-- loop through the data that is returned from 'app/http/Controllers/HomeController.php' -->
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
                        <div class="my-4 text-center">Geen treinen in de komende 24u
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
