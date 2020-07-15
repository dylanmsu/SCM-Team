@extends('layouts.app')

@section('title', 'Board Info')

@section('content')
<div id="grid-container">
    <div id="prevA">
        <h3>Bord A</h3>
        <board-preview class="basic-card" splitflapdata="{{$boardA[0]}}"/>
    </div>
    <div id="prevB">
        <h3>Bord B</h3>
        <board-preview class="basic-card" splitflapdata="{{$boardB[0]}}"/>
    </div>
    <table id="list" class="basic-card">
        <tr>
            <th class="board">board</th>
            <th class="first-text">first text</th>
            <th class="second-text">second text</th>
            <th class="icon">icon</th>
            <th class="date">date</th>
        </tr>

        @foreach ($data as $item)
        <tr>
            <td>{{$item->board}}</td>
            <td>{{$item->first_text}}</td>
            <td>{{$item->second_text}}</td>
            <td>{{$item->icon_index}}</td>
            <td>{{$item->time}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
<style>
    #grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: 20px;
    }
    
    #prevA {
        grid-row: 1;
        grid-column: 1;
        display: block;
        margin: 0 auto;
        width: 60%;
    }
    
    #prevB {
        grid-row: 1;
        grid-column: 2;
        display: block;
        margin: 0 auto;
        width: 60%;
    }
    
    #list {
        grid-column: 1/3;
        display: block;
        table-layout: fixed;
        margin: 0 auto;
        font-size: 1em;
        font-weight: bold;
        width: 80%;
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
    .icon {width: calc(5vw * 0.8);}
    .date {width: calc(30vw * 0.8);}
    
    
    
    tr:nth-child(even) {
        background-color: lightgreen;
    }
    
    tr:nth-child(odd) {
        background-color: white;
    }
    
    @media only screen and (max-width: 1000px){
        #grid-container {
            display: grid;
            grid-template-columns: 1fr;
        }
    
        #prevA {
            grid-row: 1;
            grid-column: 1;
            display: block;
            margin: 0 auto;
            width: 80%;
        }
    
        #prevB {
            grid-row: 2;
            grid-column: 1;
            display: block;
            margin: 0 auto;
            width: 80%;
            padding: 0;
        }
    
        #list {
            font-size: .7em;
        }
    }
</style>