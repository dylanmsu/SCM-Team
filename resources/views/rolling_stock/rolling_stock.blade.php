@extends('layouts.app')

@section('title', 'Rollend')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rollend Matrieel</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="my-2 col-sm-12 col-sm-12 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <h2>Normaalspoor</h2>
                            </div>
                            <div class="text-right col-md-4">
                                <h2><a href="{{route('add_stock')}}"><i class="material-icons">&#xE147;</i></a></h2>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="card-body p-0">
                    <div id="normal-accordion">
                        @forelse ($normal_categories as $category)
                            <div class="card">
                                <button class="py-2 card-header btn btn-link" data-toggle="collapse" data-target="#collapse-normal-{{$category->category}}" aria-expanded="true" aria-controls="collapse-normal-{{$category->category}}">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="text-left">{{$category->category}}</div >
                                            </div>
                                            <div class="col-md-7 text-right">
                                                @foreach ($normal_data as $item)
                                                    @if ($item->category == $category->category)
                                                        @switch($item['state'])
                                                            @case('in_dienst')
                                                                <span class="status text-success">&bull;</span>
                                                                @break
                                                            @case('buiten_dienst')
                                                                <span class="status text-danger">&bull;</span>
                                                                @break
                                                            @case('in_reserve')
                                                                <span class="status text-primary">&bull;</span>
                                                                @break
                                                            @case('onder_voorwaarde')
                                                                <span class="status text-warning">&bull;</span>
                                                                @break
                                                            @default
                                                                <span class="status text-secondary">&bull;</span>
                                                        @endswitch
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            
                                <div id="collapse-normal-{{$category->category}}" class="collapse" aria-labelle data-parent="#normal-accordion">
                                    <div class="card-body">
                                        <div class="list-group container">
                                            @forelse ($normal_data as $item)
                                                @if ($item->category == $category->category)
                                                    <div class="panel-group" id="accordion2">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <div class="row m-0 list-group-item d-flex list-group-item-action">
                                                                    <div class="col">
                                                                        @if ($item['comment'] != '')
                                                                            <a id="accordion-normal" data-toggle="collapse" data-parent="#accordion-normal" href="#collapse-normal-{{$item['id']}}">
                                                                                <span class="align-middle">{{$item['name']}}</span>
                                                                                <span class="align-middle material-icons">expand_more</span>
                                                                            </a>
                                                                        @else
                                                                            <a>
                                                                                <span class="align-middle">{{$item['name']}}</span>
                                                                            </a>
                                                                        @endif
                                                                    </div>                     
                                                                    <div class="col-6">
                                                                        @switch($item['state'])
                                                                            @case('in_dienst')
                                                                                <span class="status text-success">&bull;</span>
                                                                                In Dienst
                                                                                @break
                                                                            @case('buiten_dienst')
                                                                                <span class="status text-danger">&bull;</span>
                                                                                Buiten Dienst
                                                                                @break
                                                                            @case('in_reserve')
                                                                                <span class="status text-primary">&bull;</span>
                                                                                In Reserve
                                                                                @break
                                                                            @case('onder_voorwaarde')
                                                                                <span class="status text-warning">&bull;</span>
                                                                                Onder Voorwaarde
                                                                                @break
                                                                            @default
                                                                                <span class="status text-secondary">&bull;</span>
                                                                                Andere
                                                                        @endswitch
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <div class="d-inline mx-2 text-right">
                                                                            <a role="button" id="drpdwn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Aanpassen" data-toggle="tooltip" class="text-info material-icons">&#xE8B8;</i>
                                                                            </a>
                                                                            <div class="dropdown-menu" aria-labelledby="drpdwn">
                                                                                <form method="POST" autocomplete="off" id="delete">
                                                                                    @csrf
                                                                                    <button onclick="confirmation('delete')" formaction="rollend/verwijder/{{$item['id']}}" class="dropdown-item">Verwijderen</button>
                                                                                </form>
                                                                                <a class="dropdown-item" href="#">Bijwerken</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-inline text-right">
                                                                            <a role="button" id="drpdwn-status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Status" data-toggle="tooltip" class="text-info material-icons text-success">edit</i>
                                                                            </a>
                                                                            <div class="dropdown-menu" aria-labelledby="drpdwn-status">
                                                                                <form method="POST" autocomplete="off">
                                                                                    @csrf
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/in_dienst" class="dropdown-item" href="#"><span class="status text-success">&bull;</span><b>In Dienst</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/buiten_dienst" class="dropdown-item" href="#"><span class="status text-danger">&bull;</span><b>Buiten Dienst</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/in_reserve" class="dropdown-item" href="#"><span class="status text-primary">&bull;</span><b>In Reserve</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/onder_voorwaarde" class="dropdown-item" href="#"><span class="status text-warning">&bull;</span><b>Onder Voorwaarde</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/andere" class="dropdown-item" href="#"><span class="status text-secondary">&bull;</span><b>Andere</b></button>
                                                                                </form>
                                                                            </div>
                                                                        </div>      
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="collapse-normal-{{$item['id']}}" class="card-header collapse in">
                                                                <div class="panel-body">
                                                                    @if ($item['comment'] != '')
                                                                        {{$item['comment']}}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td>
                                                        No Data
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card">
                                <div class="card-header">No Data :(</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>


        <div class="my-2 col-sm-12 col-sm-12 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <h2>Normaalspoor</h2>
                            </div>
                            <div class="text-right col-md-4">
                                <h2><a href="{{route('add_stock')}}"><i class="material-icons">&#xE147;</i></a></h2>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="card-body p-0">
                    <div id="small-accordion">
                        @forelse ($small_categories as $category)
                            <div class="card">
                                <button class="py-2 card-header btn btn-link" data-toggle="collapse" data-target="#collapse-small-{{$category->category}}" aria-expanded="true" aria-controls="collapse-normal-{{$category->category}}">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="text-left">{{$category->category}}</div >
                                            </div>
                                            <div class="col-md-7 text-right">
                                                @foreach ($small_data as $item)
                                                    @if ($item->category == $category->category)
                                                        @switch($item['state'])
                                                            @case('in_dienst')
                                                                <span class="status text-success">&bull;</span>
                                                                @break
                                                            @case('buiten_dienst')
                                                                <span class="status text-danger">&bull;</span>
                                                                @break
                                                            @case('in_reserve')
                                                                <span class="status text-primary">&bull;</span>
                                                                @break
                                                            @case('onder_voorwaarde')
                                                                <span class="status text-warning">&bull;</span>
                                                                @break
                                                            @default
                                                                <span class="status text-secondary">&bull;</span>
                                                        @endswitch
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            
                                <div id="collapse-small-{{$category->category}}" class="collapse" aria-labelle data-parent="#small-accordion">
                                    <div class="card-body">
                                        <div class="list-group container">
                                            @forelse ($small_data as $item)
                                                @if ($item->category == $category->category)
                                                    <div class="panel-group" id="accordion2">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <div class="row m-0 list-group-item d-flex list-group-item-action">
                                                                    <div class="col">
                                                                        <a id="accordion-small" data-toggle="collapse" data-parent="#accordion-small" href="#collapse-small-{{$item['id']}}">
                                                                            {{$item['name']}}
                                                                            @if ($item['comment'] != '')
                                                                                <span class="material-icons">expand_more</span>
                                                                            @endif
                                                                        </a>
                                                                    </div>                     
                                                                    <div class="col-6">
                                                                        @switch($item['state'])
                                                                            @case('in_dienst')
                                                                                <span class="status text-success">&bull;</span>
                                                                                In Dienst
                                                                                @break
                                                                            @case('buiten_dienst')
                                                                                <span class="status text-danger">&bull;</span>
                                                                                Buiten Dienst
                                                                                @break
                                                                            @case('in_reserve')
                                                                                <span class="status text-primary">&bull;</span>
                                                                                In Reserve
                                                                                @break
                                                                            @case('onder_voorwaarde')
                                                                                <span class="status text-warning">&bull;</span>
                                                                                Onder Voorwaarde
                                                                                @break
                                                                            @default
                                                                                <span class="status text-secondary">&bull;</span>
                                                                                Andere
                                                                        @endswitch
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <div class="d-inline mx-2 text-right">
                                                                            <a role="button" id="drpdwn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Aanpassen" data-toggle="tooltip" class="text-info material-icons">&#xE8B8;</i>
                                                                            </a>
                                                                            <div class="dropdown-menu" aria-labelledby="drpdwn">
                                                                                <form method="POST" autocomplete="off" id="delete">
                                                                                    @csrf
                                                                                    <button onclick="confirmation('delete')" formaction="rollend/verwijder/{{$item['id']}}" class="dropdown-item">Verwijderen</button>
                                                                                </form>
                                                                                <a class="dropdown-item" href="#">Bijwerken</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-inline text-right">
                                                                            <a role="button" id="drpdwn-status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Status" data-toggle="tooltip" class="text-info material-icons text-success">edit</i>
                                                                            </a>
                                                                            <div class="dropdown-menu" aria-labelledby="drpdwn-status">
                                                                                <form method="POST" autocomplete="off">
                                                                                    @csrf
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/in_dienst" class="dropdown-item" href="#"><span class="status text-success">&bull;</span><b>In Dienst</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/buiten_dienst" class="dropdown-item" href="#"><span class="status text-danger">&bull;</span><b>Buiten Dienst</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/in_reserve" class="dropdown-item" href="#"><span class="status text-primary">&bull;</span><b>In Reserve</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/onder_voorwaarde" class="dropdown-item" href="#"><span class="status text-warning">&bull;</span><b>Onder Voorwaarde</b></button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/state/andere" class="dropdown-item" href="#"><span class="status text-secondary">&bull;</span><b>Andere</b></button>
                                                                                </form>
                                                                            </div>
                                                                        </div>      
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="collapse-small-{{$item['id']}}" class="card-header collapse in">
                                                                <div class="panel-body">
                                                                    @if ($item['comment'] != '')
                                                                        {{$item['comment']}}
                                                                    @else
                                                                        Geen commentaar voor dit voertuig :o
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td>
                                                        No Data
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card">
                                <div class="card-header">No Data :(</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection