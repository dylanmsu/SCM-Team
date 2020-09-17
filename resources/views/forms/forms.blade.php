@extends('layouts.app')

@section('title', 'Forms')

@section('content')
    <div class="container">
        <!-- breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rollend Matrieel</li>
            </ol>
        </nav>

        @php
            $home_cards = array(
                array('color' => '#00cec9', 'icon' => 'subway', 'name' => 'Rollend matrieel', 'target' => "", 'link' => route('vehicles'))
            );
        @endphp

        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-xl-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <h4 class="mt-2">Formulieren</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row text-center">
                                <!-- loop through the array above to create the cards -->
                                @foreach ($home_cards as $card)
                                    <div class="my-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                        <a class="card shadow-sm my-card text-decoration-none" href="{{ $card['link'] }}" target="{{ $card['target'] }}">
    
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
        </div>
    </div>
@endsection