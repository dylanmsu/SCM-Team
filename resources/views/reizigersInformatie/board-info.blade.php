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
        <div class="col-md-12">
            <div class="card py-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 my-2">
                            <h2>Splitflap beheer</h2>
                        </div>
                        <div class="col-md-7 my-2 text-right">
                            <a href="{{route('add_members')}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Toevoegen</span></a>					
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Spoor</th>						
                                <th scope="col">Text</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                            @if ($item->id == $boardA[0]->id || $item->id == $boardB[0]->id)
                                <tr class="table-primary">
                            @else
                                <tr>
                            @endif
                                    <th scope="row">
                                        {{$item->id}}
                                    </th>
                                    <td>
                                        {{$item->board}}
                                    </td>
                                    <td>
                                        {{$item->first_text}} {{$item->second_text}}
                                    </td>                        
                                    <td>
                                        {{$item->time}}
                                    </td>
                                    <td>
                                        <a role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i title="Aanpassen" data-toggle="tooltip" class="text-info material-icons">&#xE8B8;</i>
                                        </a>
                                    
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">Bijwerken</a>
                                            <a class="dropdown-item" href="#">Verwijderen</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td>
                                    geen data
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- will be replaced with a laravel implementation -->
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>{{count($data)}}</b> out of <b>{{$count[0]->count}}</b> entries</div>
                        <ul class="pagination justify-content-end">
                            {{ $data->links() }}
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection