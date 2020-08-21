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

        @forelse ($data as $list)
            <!-- normaalspoor list -->
        <div class="my-2 col-sm-12 col-sm-12 col-lg-6 col-xl-6">
            <div class="card">

                <!-- title and add-button of the normaalspoor list -->
                <div class="card-header">
                    <div class="container-fluid m-0">
                        <div class="row">
                            <div class="col-10 p-0">
                                <h2 class="text-capitalize">{{$list['type']}}Spoor</h2>
                            </div>
                            <div class="text-right col-2 p-0">
                                <h2><a href="{{route('add_stock')}}"><i class="material-icons">&#xE147;</i></a></h2>
                            </div>
                        </div>
                    </div> 
                </div>

                <!-- normaalspoor accoidion list  -->
                <div class="card-body p-0">
                    <div id="{{$list['type']}}-accordion">

                        <!-- 
                            loop through the categories and display them in a list. 
                            The array $$normal_categories comes from 
                            app\Http\Controllers\RollingStockController.php
                         -->
                        @forelse ($list['categories'] as $category)
                            <div class="card">
                                <button class="py-2 card-header btn btn-link" data-toggle="collapse" data-target="#collapse-{{$list['type']}}-{{$category->category}}" aria-expanded="true" aria-controls="collapse-{{$list['type']}}-{{$category->category}}">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="text-left">{{$category->category}}</div >
                                            </div>

                                            <!-- display the status dots  -->
                                            <div class="col-6 text-right">
                                                @foreach ($list['data'] as $item)
                                                    @if ($item->category == $category->category)
                                                        @switch($item['state'])
                                                            @case('in_dienst')
                                                                <span class="status text-success">&bull;</span><!-- green -->
                                                                @break
                                                            @case('buiten_dienst')
                                                                <span class="status text-danger">&bull;</span><!-- red -->
                                                                @break
                                                            @case('in_reserve')
                                                                <span class="status text-primary">&bull;</span><!-- blue -->
                                                                @break
                                                            @case('onder_voorwaarde')
                                                                <span class="status text-warning">&bull;</span><!-- yellow -->
                                                                @break
                                                            @default
                                                                <span class="status text-secondary">&bull;</span><!-- gray -->
                                                        @endswitch
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            
                                <!-- the list under each category -->
                                <div id="collapse-{{$list['type']}}-{{$category->category}}" class="collapse" aria-labelle data-parent="#{{$list['type']}}-accordion">
                                    <div class="card-body">
                                        <div class="list-group container">

                                            @forelse ($list['data'] as $item)

                                                @if ($item->category == $category->category)
                                                    <div class="panel-group" id="accordion2">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading p-0">
                                                                <div class="row m-0 list-group-item d-flex list-group-item-action">
                                                                    <div class="col-7 col-sm col-md">

                                                                        <!-- if the row has a comment, add icon next to name to show you can expand else, display only name -->
                                                                        @if ($item['comment'] != '')
                                                                            <a id="accordion-{{$list['type']}}" data-toggle="collapse" data-parent="#accordion-normal" href="#collapse-normal-{{$item['id']}}">
                                                                                <span class="align-middle"><b>{{$item['name']}}</b></span>
                                                                                <span class="align-middle material-icons">expand_more</span>
                                                                            </a>
                                                                        @else
                                                                            <a>
                                                                                <span class="align-middle"><b>{{$item['name']}}</b></span>
                                                                            </a>
                                                                        @endif
                                                                    </div>                     
                                                                    <div class="col-7 col-sm col-md">
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
                                                                                Voorwaarde
                                                                                @break
                                                                            @default
                                                                                <span class="status text-secondary">&bull;</span>
                                                                                Andere
                                                                        @endswitch
                                                                    </div>

                                                                    <!-- add edit tools for each row -->
                                                                    <div class="col-5 col-sm col-md text-right">
                                                                        <div class="d-inline mx-2 text-right">
                                                                            <a role="button" id="drpdwn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Aanpassen" data-toggle="tooltip" class="fas fa-cog text-info fa-1x"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu" aria-labelledby="drpdwn">
                                                                                <form method="POST" autocomplete="off" id="delete">
                                                                                    @csrf
                                                                                    <button onclick="confirmation('delete')" formaction="rollend/verwijder/{{$item['id']}}" class="dropdown-item"><i class="fas fa-trash-alt"></i> Verwijderen</button>
                                                                                </form>
                                                                                <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Bijwerken</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-inline text-right">
                                                                            <a role="button" id="drpdwn-status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Status" data-toggle="tooltip" class="fas fa-exclamation-circle text-info fa-1x"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu" aria-labelledby="drpdwn-status">
                                                                                <form method="POST" autocomplete="off">
                                                                                    @csrf
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/in_dienst" class="dropdown-item" href="#"><span class="status text-success">&bull;</span>In Dienst</button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/buiten_dienst" class="dropdown-item" href="#"><span class="status text-danger">&bull;</span>Buiten Dienst</button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/in_reserve" class="dropdown-item" href="#"><span class="status text-primary">&bull;</span>In Reserve</button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/onder_voorwaarde" class="dropdown-item" href="#"><span class="status text-warning">&bull;</span>Onder Voorwaarde</button>
                                                                                    <button type="submit" formaction="rollend/update/{{$item['id']}}/andere" class="dropdown-item" href="#"><span class="status text-secondary">&bull;</span>Andere</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>      
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- if there is a comment, display it -->
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
        @empty
            nothing
        @endforelse
    </div>
</div>
@endsection