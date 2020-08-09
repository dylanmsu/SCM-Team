@extends('layouts.app')

@section('title', 'links')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Links</li>
        </ol>
    </nav>
    
    <div class="row justify-content-center">
        @php
            $links = array(
                array('img' => './images/main/scmteam.png',   'name' => 'SCM-Team',            'target' => "",        'link' => "https://www.scm-team.be"),
                array('img' => './images/main/one.png',       'name' => 'One.com',             'target' => "",        'link' => "https://login.one.com/cp"),
                array('img' => './images/main/stme.png',      'name' => 'Stoomtrein Maldegem', 'target' => "",        'link' => "https://www.stoomtreinmaldegem.be/nl"),
                array('img' => './images/main/academy.png',   'name' => 'Academy',             'target' => "",        'link' => "https://academy.scm-team.be"),
                array('img' => './images/main/forms.png',     'name' => 'SCM-Formulieren',     'target' => "",        'link' => "https://forms.scm-team.be"),
                array('img' => './images/main/mailchimp.png', 'name' => 'Mailchimp',           'target' => "",        'link' => "https://login.mailchimp.com/")
            );
        @endphp

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Links</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row text-center">
                            
                            <!-- loop through the array above to create the cards -->
                            @foreach ($links as $card)
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
    </div>
</div>
@endsection
