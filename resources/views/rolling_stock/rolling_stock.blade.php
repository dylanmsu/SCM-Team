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
            <div class="card shadow-sm">

                <!-- title and add-button of the normaalspoor list -->
                <div class="card-header">
                    <div class="container-fluid m-0">
                        <div class="row">
                            <div class="col-9 p-0">
                                <h2 class="text-capitalize">{{$list['type']}}Spoor</h2>
                            </div>
                            <div class="text-right col-3 p-0">
                                <h2>
                                    <a title="voeg toe" href="{{route('add_stock')}}"><i class="fas fa-plus-square"></i></a>
                                    <a title="exporteer Excel" href="{{route('export-vehicles')}}"><i class="fas fa-cloud-download-alt"></i></a>
                                </h2>
                            </div>
                        </div>
                    </div> 
                </div>

                <!-- category accoidion list -->
                <div class="card-body p-0">
                    <div id="{{$list['type']}}-accordion">

                        <!-- loop through the categories and display them in a list.  -->
                        @forelse ($list['categories'] as $category)
                            <div class="card">
                                <div class="py-2 card-header btn btn-link" data-toggle="collapse" role="button" data-target="#collapse-{{$list['type']}}-{{$category->category}}" aria-expanded="true" aria-controls="collapse-{{$list['type']}}-{{$category->category}}">
                                    <div class="container">
                                        <div class="row">

                                            <!-- category name -->
                                            <div class="col-6">
                                                <div class="text-left">{{$category->category}}</div >
                                            </div>

                                            <!-- display the status dots  -->
                                            <div class="col-6 text-right">
                                                @foreach ($list['data'] as $item)
                                                    @if ($item->category == $category->category)
                                                        @switch($item->state)
                                                            @case('in_dienst')
                                                                <span class="m-0 status text-success">&bull;</span><!-- green -->
                                                                @break
                                                            @case('buiten_dienst')
                                                                <span class="m-0 status text-danger">&bull;</span><!-- red -->
                                                                @break
                                                            @case('in_reserve')
                                                                <span class="m-0 status text-primary">&bull;</span><!-- blue -->
                                                                @break
                                                            @case('onder_voorwaarde')
                                                                <span class="m-0 status text-warning">&bull;</span><!-- yellow -->
                                                                @break
                                                            @default
                                                                <span class="m-0 status text-secondary">&bull;</span><!-- gray -->
                                                        @endswitch
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- the list under each category -->
                                <div id="collapse-{{$list['type']}}-{{$category->category}}" class="collapse" data-parent="#{{$list['type']}}-accordion">
                                    <div class="card-body">
                                        <div class="list-group container px-0">
                                            
                                            @forelse ($list['data'] as $item)

                                                @if ($item->category == $category->category)
                                                    <div class="panel-group">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading p-0">
                                                                <div class="row btn m-0 list-group-item d-flex list-group-item-action" id="accordion-{{$list['type']}}" data-toggle="collapse" data-parent="#accordion-{{$list['type']}}" href="#collapse-{{$item->id}}">
                                                                    <div class="col-7 col-sm col-md">
                                                                        <a>
                                                                            <span class="my-0 align-middle"><b>{{$item->name}}</b></span>
                                                                            <span class="my-0 align-middle material-icons">expand_more</span>
                                                                        </a>
                                                                    </div>                     
                                                                    <div class="col-7 col-sm col-md">
                                                                        @switch($item->state)
                                                                            @case('in_dienst')
                                                                                <span class="my-0 status text-success">&bull;</span>
                                                                                In Dienst
                                                                                @break
                                                                            @case('buiten_dienst')
                                                                                <span class="my-0 status text-danger">&bull;</span>
                                                                                Buiten Dienst
                                                                                @break
                                                                            @case('in_reserve')
                                                                                <span class="my-0 status text-primary">&bull;</span>
                                                                                In Reserve
                                                                                @break
                                                                            @case('onder_voorwaarde')
                                                                                <span class="my-0 status text-warning">&bull;</span>
                                                                                Voorwaarde
                                                                                @break
                                                                            @default
                                                                                <span class="my-0 status text-secondary">&bull;</span>
                                                                                Andere
                                                                        @endswitch
                                                                    </div>

                                                                    <!-- add edit tools for each row -->
                                                                    <div class="my-0 h5 col-5 col-sm col-md text-right">
                                                                        <span class="d-inline text-right align-bottom">
                                                                            <a role="button" id="edit-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i title="Aanpassen" data-toggle="tooltip" class="fas fa-cog text-info fa-1x"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu" aria-labelledby="edit-{{$item->id}}">
                                                                                <form method="POST" autocomplete="off" action="rollend/verwijder/{{$item->id}}" id="delete-{{$item->id}}">
                                                                                    @csrf
                                                                                    <div onclick="confirmation('delete-{{$item->id}}')" class="btn dropdown-item"><i class="fas fa-trash-alt"></i> Verwijderen</div>
                                                                                </form>
                                                                                <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Bijwerken</a>
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
                                                                    <form class="mt-2" action="/rollend/comment/add/{{$item->id}}" method="POST">
                                                                        @csrf
                                                                        <div class="input-group">
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
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
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