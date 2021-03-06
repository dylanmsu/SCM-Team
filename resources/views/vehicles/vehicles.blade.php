@extends('layouts.app')

@section('title', 'Rollend Materieel')

@section('content')
<div class="container px-1">

    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rollend Matrieel</li>
        </ol>
    </nav>

    <!-- the content itself -->
    <div class="card mt-2">
        <div class="card-header container">
            <div class="row">
                
                <!-- major title -->
                <div class="col-md-6 my-2 text-center text-md-left">
                    <h2 class="mb-0">Rollend Matrieel</h2>
                </div>

                <!-- add and export buttons -->
                <div class="col-md-6 my-0 text-center text-md-right">
                    <a href="{{route('add_vehicle_page')}}" class="ml-2 my-2 btn btn-primary"> <i class="fas fa-plus"></i> Toevoegen</a>	
                    <a href="{{route('export-vehicles')}}" class="ml-2 my-2 btn btn-primary"> <i class="fas fa-cloud-download-alt"></i> Download Excel</a>					
                </div>
            </div>
        </div>

        <!-- the content under the title and buttons -->
        <div class="card-body px-0 px-sm-3">
            <div class="container p-1 p-sm-3">
                <div class="row">
                    
                @forelse ($data as $list)
                    <!-- normaalspoor / smalspoor list -->
                    <div class="col-sm-12 col-sm-12 col-lg-6 col-xl-6">
                        <div class="card shadow-sm mb-4">

                            <!-- title and add-button of the normaalspoor list -->
                            <div class="card-header">
                                <h3 class="mb-0 text-capitalize">{{$list['type']}}spoor</h3>
                            </div>

                            <!-- category accoidion list -->
                            <div class="card-body p-1 p-sm-3">
                                <div id="{{$list['type']}}-accordion">

                                    <!-- loop through the categories and display them in a list.  -->
                                    @forelse ($list['categories'] as $category)
                                        <div class="card">
                                            <div class="py-2 card-header btn btn-link" data-toggle="collapse" role="button" data-target="#collapse-{{$list['type']}}-{{$category->category}}" aria-expanded="true" aria-controls="collapse-{{$list['type']}}-{{$category->category}}">
                                                
                                                <!-- category -->
                                                <div class="text-left container">

                                                    <!-- category name -->
                                                    <b class="my-2"><strong class="text-capitalize" data-toggle="tooltip" data-placement="top" title="klik op de category om de voertuigen te zien">{{$category->category}}</strong></b>

                                                    <!-- display the status dots -->
                                                    <span style="line-height: 0">
                                                        @foreach ($list['data'] as $item)
                                                            @if ($item->category == $category->category)

                                                                <!-- display a dot based on the corresponding state -->
                                                                @switch($item->state)
                                                                    @case('in_dienst')
                                                                        <span title="In dienst" style="float: right;" class="my-2 text-right status text-success">&bull;</span><!-- green -->
                                                                        @break
                                                                    @case('buiten_dienst')
                                                                        <span title="Buiten dienst" style="float: right;" class="my-2 text-right status text-danger">&bull;</span><!-- red -->
                                                                        @break
                                                                    @case('in_reserve')
                                                                        <span title="In reserve" style="float: right;" class="my-2 text-right status text-primary">&bull;</span><!-- blue -->
                                                                        @break
                                                                    @case('onder_voorwaarde')
                                                                        <span title="Onder voorwaarde" style="float: right;" class="my-2 text-right status text-warning">&bull;</span><!-- yellow -->
                                                                        @break
                                                                    @default
                                                                        <span style="float: right;" class="my-2 text-right status text-secondary">&bull;</span><!-- gray -->
                                                                @endswitch
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                        
                                            <!-- the list under each category -->
                                            <div id="collapse-{{$list['type']}}-{{$category->category}}" class="collapse" data-parent="#{{$list['type']}}-accordion">
                                                <div class="card-body px-1">
                                                    <div class="container-fluid px-0">

                                                        <!-- loop through the vehicles -->
                                                        @forelse ($list['data'] as $item)
                                                            @if ($item->category == $category->category)

                                                            <!-- the vehicles under each category -->
                                                            <div class="list-group">
                                                                <div class="row btn m-0 list-group-item d-flex list-group-item-action" id="accordion-{{$list['type']}}" data-parent="#accordion-{{$list['type']}}">
                                                                    
                                                                    <!-- vehicle name -->
                                                                    <div class="col-4 px-0">
                                                                        <a  href="{{route('show_properties', $item->id)}}">
                                                                            <span title="Toon eigenschappen" class="my-0"><b>{{$item->name}}</b></span>
                                                                        </a>
                                                                    </div>    

                                                                    <!-- vehicle status -->
                                                                    <a class="col-7 px-0" title="Toon status en commentaar" href="#collapse-{{$item->id}}" data-toggle="collapse">
                                                                        @switch($item->state)
                                                                            @case('in_dienst')
                                                                                <span class="text-success">&bull;</span>
                                                                                <b>In Dienst</b>
                                                                                @break
                                                                            @case('buiten_dienst')
                                                                                <span class="text-danger">&bull;</span>
                                                                                Buiten Dienst
                                                                                @break
                                                                            @case('in_reserve')
                                                                                <span class="text-primary">&bull;</span>
                                                                                In Reserve
                                                                                @break
                                                                            @case('onder_voorwaarde')
                                                                                <span class="text-warning">&bull;</span>
                                                                                Voorwaarde
                                                                                @break
                                                                            @default
                                                                                <span class="text-secondary">&bull;</span>
                                                                                Andere
                                                                        @endswitch
                                                                    </a>

                                                                    <!-- add edit tools for the vehicles -->
                                                                    <div class="col-1 px-0 px-0 my-0 h5 text-right">
                                                                        <span class="d-inline text-right">

                                                                            <!-- edit -->
                                                                            <a role="button" id="edit-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Aanpassen" data-toggle="tooltip" class="fas fa-cog text-info fa-1x"></i>
                                                                            </a>

                                                                            <!-- delete -->
                                                                            <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="edit-{{$item->id}}">
                                                                                <form method="POST" autocomplete="off" action="rollend/verwijder/{{$item->id}}" id="delete-{{$item->id}}">
                                                                                    @csrf
                                                                                    <div onclick="confirmation('delete-{{$item->id}}')" class="btn dropdown-item"><i class="fas fa-trash-alt"></i> Verwijderen</div>
                                                                                </form>
                                                                                <a class="dropdown-item" href="rollend/bijwerken/{{$item->id}}"><i class="fas fa-edit"></i> Bijwerken</a>
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            
                                                            <div id="collapse-{{$item->id}}" class="card-header collapse in">
                                                                <div class="panel-body">
                                                                    
                                                                    <!-- display the comments -->
                                                                    @forelse ($item->vehicle_comment as $comment)
                                                                        <div id="comments-{{$item->id}}" class="collapse in">
                                                                            @if(!$loop->last)
                                                                                <b>{{$comment->user->username}}</b>: <span style="float:right;">{{$comment->updated_at}}</span> 
                                                                                <div class="container">
                                                                                    <div class="row justify-content-center">
                                                                                        <div class="my-2 col-10 card py-2">
                                                                                            <div class="card-body p-2">
                                                                                                {{$comment->remarks}}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    
                                                                        @if($loop->last)
                                                                            @if (count($item->vehicle_comment) > 1)
                                                                                <a data-toggle="collapse" href="#comments-{{$item->id}}">meer</a>
                                                                            @endif
                                                                            <div><b>{{$comment->user->username}}</b>: <span style="float:right;">{{$comment->updated_at}}</span> </div>
                                                                            <div class="container">
                                                                                <div class="row justify-content-center">
                                                                                    <div class="card my-2 col-10">
                                                                                        <div class="card-body p-2">
                                                                                            {{$comment->remarks}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @empty
                                                                        <div class="text-center">Geen commentaar</div> 
                                                                    @endforelse
                                                                    
                                                                    <!-- add comment form -->
                                                                    <form class="mt-2 input-group" action="/rollend/comment/add/{{$item->id}}" method="POST">
                                                                        @csrf

                                                                        <input type="hidden" name="type" value="{{$list['type']}}">
                                                                        <input type="hidden" name="category" value="{{$category->category}}">
                                                                        <input type="hidden" name="vehicle" value="#collapse-{{$item->id}}">
                                                                        
                                                                        <div class="input-group-prepend">
                                                                            <select id="state" class="input-group-text form-control" name="state">
                                                                                <option class="text-success" value="in_dienst" {{ old('state') == 'in_dienst' ? 'selected' : '' }}>
                                                                                    In Dienst
                                                                                </option>
                                                                                <option class="text-danger" value="buiten_dienst" {{ old('state') == 'buiten_dienst' ? 'selected' : '' }}>
                                                                                    Buiten Dienst
                                                                                </option>
                                                                                <option class="text-primary" value="in_reserve" {{ old('state') == 'in_reserve' ? 'selected' : '' }}>
                                                                                    In Reserve
                                                                                </option>
                                                                                <option class="text-warning" value="onder_voorwaarde" {{ old('state') == 'onder_voorwaarde' ? 'selected' : '' }}>
                                                                                    Voorwaarde
                                                                                </option>
                                                                                <option class="text-secondary" value="andere" {{ old('state') == 'andere' ? 'selected' : '' }}>
                                                                                    Andere
                                                                                </option>
                                                                            </select>
                                                                        </div> 
                                                                        <input id="name" type="text" placeholder="Commentaar" class="form-control" name="remarks" autocomplete="comment" required>
                                                                        <div class="input-group-prepend">
                                                                            <button class="btn btn-primary" type="submit">
                                                                                <i class="fas fa-arrow-right"></i>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>  
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card">
                                            <div class="card-header text-center">Geen gegevens beschikbaar <strong>:-(</strong></div>
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
        </div>
    </div>
</div>
@endsection