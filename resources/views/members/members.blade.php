@extends('layouts.app')

@section('title', 'Leden beheer')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Leden</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card py-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 my-2">
                            <h2>Leden <b>Beheer</b></h2>
                        </div>
                        <div class="col-md-7 my-2 text-right">
                            <a href="{{route('add_members')}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Nieuw lid toevoegen</span></a>
                            <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE24D;</i> <span>Exporteer Excel</span></a>						
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    @php
                        $members = array(
                            array('id' => '1', 'name' => 'First Lastname', 'number' => '+32470296996', 'function' => 'Admin',      'email' => 'dylan.missu@gmail.com'),
                            array('id' => '2', 'name' => 'First Lastname', 'number' => '+32470296996', 'function' => 'Bestuurder', 'email' => 'dylan.missu@gmail.com'),
                            array('id' => '3', 'name' => 'First Lastname', 'number' => '+32470296996', 'function' => 'Conducteur', 'email' => 'dylan.missu@gmail.com'),
                            array('id' => '4', 'name' => 'First Lastname', 'number' => '+32470296996', 'function' => 'Conducteur', 'email' => 'dylan.missu@gmail.com'),
                            array('id' => '5', 'name' => 'First Lastname', 'number' => '+32470296996', 'function' => 'Bestuurder', 'email' => 'dylan.missu@gmail.com'),
                        );
                    @endphp
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>						
                                <th>GSM nummer</th>
                                <th>Top Functie</th>
                                <th>Email</th>
                                <th>Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $item)
                                <tr>
                                    <td>
                                        {{$item['id']}}
                                    </td>
                                    <td>
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        </svg>
                                        <a>{{$item['name']}}</a>
                                    </td>
                                    <td>
                                        {{$item['number']}}
                                    </td>                        
                                    <td>
                                        <span class="status text-success">&bull;</span>
                                        {{$item['function']}}
                                    </td>
                                    <td>
                                        {{$item['email']}}
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
                                    No Data
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- will be replaced with a laravel implementation -->
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled"><a href="#" class="page-link">Previous</a></li>
                            <li class="page-item active"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link">Next</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection