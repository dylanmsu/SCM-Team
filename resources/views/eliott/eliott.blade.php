@extends('layouts.app')

@section('title', 'Eigenschappen')

@section('content')
<div class="container">

    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active li-success" aria-current="page">Eliott</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            Header name
        </div>
        <div class="card-body">
            hello world
        </div>
    </div>
</div>
@endsection