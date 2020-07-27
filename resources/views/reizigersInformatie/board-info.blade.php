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
                <div id="list">
                    <table>
                        <tr>
                            <th class="board">bord</th>
                            <th class="first-text">tekst bovenaan</th>
                            <th class="second-text">tekst onderaan</th>
                            <th class="icon">trein</th>
                            <th class="date">tijd</th>
                        </tr>

                        @if (!$data->isEmpty())
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$item->board}}</td>
                                <td>{{$item->first_text}}</td>
                                <td>{{$item->second_text}}</td>
                                @switch($item->icon_index)
                                    @case(1)
                                        <td>IC</td>
                                        @break
                                    @case(2)
                                        <td>IR</td>
                                        @break
                                    @case(3)
                                        <td>L</td>
                                        @break
                                    @case(4)
                                        <td>P</td>
                                        @break
                                    @case(5)
                                        <td>EXP</td>
                                        @break
                                    @case(6)
                                        <td style="color: red">IR</td>
                                        @break
                                    @case(7)
                                        <td style="color: red">IT</td>
                                        @break
                                    @case(8)
                                        <td style="color: red">?</td>
                                        @break
                                    @case(9)
                                        <td style="color: red">INT</td>
                                        @break
                                    @case(10)
                                        <td>T</td>
                                        @break
                                    @case(11)
                                        <td>STOOM</td>
                                        @break
                                    @case(12)
                                        <td>MW</td>
                                        @break
                                    @case(13)
                                        <td>KRUIS</td>
                                        @break
                                    @case(14)
                                        <td>ORIENT</td>
                                        @break
                                    @case(15)
                                        <td style="color: red">DIENST</td>
                                        @break
                                    @default
                                        <td>[blank]</td>
                                        @break
                                @endswitch
                                <td>{{$item->time}}</td>
                            </tr>
                            @endforeach
                        @else
                            no data
                        @endif
                        
                    </table>
                </div>   
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
<style>
    #grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: 20px;
    }

    #prevA {
        width: 100%;
    }
    
    #prevB {
        width: 100%;
    }

    #list {
        grid-column: 1/3;
        display: block;
        table-layout: fixed;
        margin: 0 auto;
        font-size: 1em;
        font-weight: bold;
        width: 100%;
    }
    
    th {
        border: 1px solid #ddd;
        text-align: left;
    }
    
    tr:hover {
        background-color: lightgray;
    }
    
    
    .board {width: calc(5vw * 0.8);}
    .first-text {width: calc(30vw * 0.8);}
    .second-text {width: calc(30vw * 0.8);}
    .icon {width: calc(10vw * 0.8); margin-left: 30px;}
    .date {width: calc(25vw * 0.8);}
    
    
    
    tr:nth-child(even) {
        background-color: lightgreen;
    }
    
    tr:nth-child(odd) {
        background-color: white;
    }
</style>