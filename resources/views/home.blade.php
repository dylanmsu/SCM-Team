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
                /**
                 * https://codepen.io/aniketkudale/pen/BaNxomQ
                 * Dutch palette
                 */
                array('img' => './images/main/svg/dragon.svg',    'name' => 'Elliott',          'target' => "",  'link' => route('elliott')),
                array('img' => './images/main/svg/vehicles.svg',  'name' => 'Rollend matrieel', 'target' => "",  'link' => route('vehicles')),
                array('img' => './images/main/svg/splitflap.svg', 'name' => 'Splitflap',        'target' => "",  'link' => route('ris')),
                array('img' => './images/main/svg/members.svg',   'name' => 'Ledenbeheer',      'target' => "",  'link' => route('members')),
                array('img' => './images/main/svg/files.svg',     'name' => 'Mijn bestanden',   'target' => "",  'link' => "/filemanager"),
                array('img' => './images/main/svg/links.svg',     'name' => 'Links',            'target' => "",  'link' => route('links')),
                array('img' => './images/main/svg/forms.svg',     'name' => 'Forms',            'target' => "",  'link' => "/form-builder/forms"),
                array('img' => './images/main/svg/track.svg',     'name' => 'Tracking',         'target' => "",  'link' => route('map')),
                array('img' => './images/main/svg/settings.svg',  'name' => 'Instellingen',     'target' => "",  'link' => "#"),
            );
        @endphp

        @guest

        @else
            
        @endguest

        <!-- left side -->
        <div class="col-md-8">

            <div class="card mt-4">
                <div class="card-body">
                    <div class="container">
                        <div class="row text-center">
                            <!-- loop through the array above to create the cards -->
                            @foreach ($home_cards as $card)

                                <div class="my-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12" >

                                    <a class="card shadow-sm my-card text-decoration-none" href="{{ $card['link'] }}" target="{{ $card['target'] }}">

                                        <img class="card-img-top" src="{{ asset($card['img']) }}">
                                        <div class="py-3 card-footer text-uppercase"><strong>{{ $card['name'] }}</strong></div>
                                        
                                    </a>

                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- right side -->
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
