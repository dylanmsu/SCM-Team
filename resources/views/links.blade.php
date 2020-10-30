@extends('layouts.app')

@section('title', 'Links')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @php
            $links = array(
                array('img' => './images/links/scmteam.svg',   'name' => 'SCM-Team',                  'target' => "",        'link' => "https://www.scm-team.be"),
                array('img' => './images/links/sme.svg',       'name' => 'Stoomtrein Maldegem-Eeklo', 'target' => "",        'link' => "https://www.stoomtreinmaldegem.be/nl"),
                array('img' => './images/links/academy.svg',   'name' => 'SCM-Academy',               'target' => "",        'link' => "https://academy.scm-team.be"),
                array('img' => './images/links/forms.svg',     'name' => 'SCM-Formulieren',           'target' => "",        'link' => "https://forms.scm-team.be"),
                array('img' => './images/links/mailchimp.svg', 'name' => 'Mailchimp',                 'target' => "",        'link' => "https://login.mailchimp.com/")
            );
        @endphp
        <div class="col-md-8">
            <div class="card mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Links</li>
                    </ol>
                </nav>
                @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
                <div class="card-body">
                    <div class="container">
                        <div class="row text-center">
                            <!-- loop through the array above to create the cards -->
                            @foreach ($links as $card)
                                <div class="my-3 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                    <a class="card my-card text-decoration-none" href="{{ $card['link'] }}" target="{{ $card['target'] }}">
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
    </div>
</div>
@endsection
