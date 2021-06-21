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

    @guest
        @php
            // home pagina wanneer de gebruiker een guest is
            $home_cards = array(
                array('img' => './images/main/guest/register.svg',        'name' => 'Inschrijven',      'target' => "",  'link' => route('register')),
                array('img' => './images/main/guest/links.svg',           'name' => 'Links',            'target' => "",  'link' => route('links')),
                array('img' => './images/main/guest/forms.svg',           'name' => 'Forms',            'target' => "",  'link' => "/form-builder/forms"),
                array('img' => './images/main/guest/track.svg',           'name' => 'Tracking',         'target' => "",  'link' => route('map')),
                array('img' => './images/main/guest/planner.svg',         'name' => 'Planner',          'target' => "", 'link' => route('planner')),
            );
        @endphp
    @else
        @php
            if (auth()->user()->role_id >= 3) {
                // place cards here for when the user has a role id of geater than 3 (lower = more privilege)
            }
            elseif (auth()->user()->role_id >= 2) {
                // when the use has a role id geater than 2
            }
            elseif (auth()->user()->role_id >= 1) {
                // when the use has a role id geater than 1
            }
            
            // home pagina wanneer de gebruiker is ingelogd
            $home_cards = array(
                array('img' => './images/main/admin/dragon.svg',          'name' => 'Elliott',          'target' => "",  'link' => route('elliott')),
                array('img' => './images/main/admin/vehicles.svg',        'name' => 'Rollend matrieel', 'target' => "",  'link' => route('vehicles')),
                array('img' => './images/main/admin/splitflap.svg',       'name' => 'Splitflap',        'target' => "",  'link' => route('ris')),
                
                array('img' => './images/main/admin/members.svg',         'name' => 'Ledenbeheer',      'target' => "",  'link' => route('members')),
                array('img' => './images/main/admin/files.svg',           'name' => 'Mijn bestanden',   'target' => "",  'link' => "/filemanager"),
                array('img' => './images/main/admin/links.svg',           'name' => 'Links',            'target' => "",  'link' => route('links')),
                
                array('img' => './images/main/admin/forms.svg',           'name' => 'Forms',            'target' => "",  'link' => "/form-builder/forms"),
                array('img' => './images/main/admin/track.svg',           'name' => 'Tracking',         'target' => "",  'link' => route('map')),
                array('img' => './images/main/admin/vbs.svg',             'name' => 'Veiligheidsbeheer','target' => "",  'link' => "#"),
                
                array('img' => './images/main/admin/report.svg',          'name' => 'Meldingen',        'target' => "",  'link' => "#"),
                array('img' => './images/main/admin/order.svg',           'name' => 'Aanvragen',        'target' => "",  'link' => "#"),
                array('img' => './images/main/admin/docs.svg',            'name' => 'Documentatie',     'target' => "",  'link' => "#"),
                
                array('img' => './images/main/admin/planner.svg',         'name' => 'Planner',           'target' => "", 'link' => route('planner')),
                array('img' => './images/main/admin/profile.svg',         'name' => 'Mijn Profiel',     'target' => "",  'link' => route('user_profile')),
                array('img' => './images/main/admin/settings.svg',        'name' => 'Instellingen',     'target' => "",  'link' => route('user_settings')),
            )
        @endphp
    @endguest

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
                <div class="card-header text-center text-uppercase"><strong>Geplande Ritten</strong></div>
                <div class="list-group">
                    @if (!$data->isEmpty())

                        <!-- loop through the data that is returned from 'app/http/Controllers/HomeController.php' -->
                        @foreach ($data as $item)
                            <div class="list-group">
                                <a href="{{route('ris', ['id' => $item->id])}}" class="py-2 list-group-item list-group-item-action flex-column">
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
