@extends('layouts.app')

@section('title', 'ReizigersInformatie')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">ReizigersInformatie</li>
        </ol>
    </nav>
    <div class="row justify-content-center">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="text-decoration-none my-2 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <a class="card my-card text-decoration-none" href="{{route('ris/board-info')}}">
                                <img class="card-img-top"  src="{{asset('./images/split/content.png')}}">
                                <div class="py-3 card-footer">Board Status</div>
                            </a>
                        </div>
                        <div class="text-decoration-none my-2 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <a class="card my-card text-decoration-none" href="{{route('ris/board-setup')}}">
                                <img class="card-img-top"  src="{{asset('./images/split/status.png')}}">
                                <div class="py-3 card-footer">Board Setup</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
