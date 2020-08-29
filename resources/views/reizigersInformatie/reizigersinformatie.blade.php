@extends('layouts.app')

@section('title', 'Board Info')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">ReizigersInformatie</a></li>
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
                            <a href="{{route('board-setup')}}" class="btn btn-secondary"> <i class="fas fa-plus"></i> Toevoegen</a>					
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th data-card-title>Text</th>
                                <th data-card>Spoor</th>
                                <th data-card>Datum</th>
                                <th data-card>actie</th>
                                <th data-card-footer>voorbeeld</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                            @if ($item->id == $boardA[0]->id || $item->id == $boardB[0]->id)
                                <tr class="table-primary">
                            @else
                                <tr>
                            @endif
                                    <td>
                                        <b>{{$item->first_text}} {{$item->second_text}}</b>
                                    </td>
                                    <td>
                                        {{$item->board}}
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
                                    <td class="dropdown">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-{{$item->id}}">
                                            Voorbeeld
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Voorbeeld</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <board-preview board_width="400" splitflapdata="{{$item}}"/>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
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
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="hint-text">Pagina <b>{{$data->currentPage()}}</b> van de <b>{{ceil($count[0]->count/$data->count())}}</b> pagina's</div>
                        </div>
                        <div class="col-12  col-md-6">
                            <ul class="pagination justify-content-end">
                                {{ $data->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection