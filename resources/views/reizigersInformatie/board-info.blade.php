@extends('layouts.app')

@section('title', 'Board Info')

@section('content')
<div class="container">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('ris')}}">ReizigersInformatie</a></li>
        <li class="breadcrumb-item active" aria-current="page">BoardInfo</li>
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
            <div class="card-header">{{ __('Bord Info') }}</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Bord</th>
                            <th scope="col">Tekst</th>
                            <th scope="col">Trein</th>
                            <th scope="col">Tijd</th>
                        </tr>
                    </thead>

                @if (!$data->isEmpty())
                    <tbody>
                    @foreach ($data as $item)
                    <tr scope="row">
                        <th>{{$item->board}}</th>
                        <td>{{$item->first_text}} <br> {{$item->second_text}}</td>
                        <td><my-icon v-bind:icon_index="{{$item->icon_index}}"></my-icon></td>
                        <td>{{$item->time}}</td>
                    </tr>
                    @endforeach
                    <tbody>
                @else
                    no data
                @endif
                
                </table>
                <div class="mx-2">{{ $data->links() }}</div>
            </div>
        </div>

        @php
        $blank = json_encode(array(
            'align' => 'center',
            'first_text' => 'geen treinen',
            'second_text' => 'vandaag',
            'icon_index' => '0',
            'time' => ''
        ));
        @endphp
                
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Bord A') }}</div>
                <div id="prevA">
                @if (!empty($boardA[0]))
                    <board-preview splitflapdata="{{$boardA[0]}}"/>
                @else
                    <board-preview splitflapdata="{{$blank}}"/>
                @endif
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Bord B') }}</div>
                <div id="prevB">
                @if (!empty($boardB[0]))
                    <board-preview splitflapdata="{{$boardB[0]}}"/>
                @else
                    <board-preview splitflapdata="{{$blank}}"/>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection