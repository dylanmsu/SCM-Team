@extends('layouts.app')

@section('title', 'Board Setup')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Weergave Borden</div>
                <div class="card-body">

                    @if(session('success') != "")
                    <div class="col-md-6">
                        <div class="row alert alert-success">
                            {{session('success')}}
                        </div>
                    </div>
                    @endif

                    @if(session('error') != "")
                    <div class="col-md-6">
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    </div>
                    
                    @endif

                    <form method="POST" autocomplete="off" method="post">
                        {{ csrf_field() }}

                        @if (!empty($preview))
                            <div class="form-group row">
                                <label for="test" class="col-md-4 col-form-label text-md-right">{{ __('Voorbeeld') }}</label>
                                <div class="col-md-6" id="prev">
                                    <board-preview class="basic-card" splitflapdata="{{$preview}}"/>
                                </div>
                            </div>
                        @endif
                        

                        <div class="form-group row">
                            <label for="board" class="col-md-4 col-form-label text-md-right">{{ __('Bord') }}</label>

                            <div class="col-md-6">
                                <div class="radio-container" id="board">
                                    <input checked="checked" type="radio" id="radio1" name="board" value="A" selected>
                                    <label for="radio1">Bord A</label>
                                    <input type="radio" id="radio2" name="board" value="B">
                                    <label for="radio2">Bord B</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="align" class="col-md-4 col-form-label text-md-right">{{ __('Uitlijnen') }}</label>
                            <div class="col-md-6">
                                <div id="align" class="radio-container text-align">
                                    <input checked="checked" type="radio" name="align" id="left" value="left" selected>
                                    <label for="left">links</label>
                                    <input type="radio" name="align" id="center" value="center">
                                    <label for="center">center</label>
                                    <input type="radio" name="align" id="right" value="right">
                                    <label for="right">rechts</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icoon') }}</label>
                            <div class="col-md-6">
                                <select name="icon_index" class="basic-inputstyle">
                                    <option value="0" checked="checked">[blank]</option>
                                    <option value="1">IC</option>
                                    <option value="2">IR</option>
                                    <option value="3">L</option>
                                    <option value="4">P</option>
                                    <option value="5">EXP</option>
                                    <option value="6" style="color: red">IR</option>
                                    <option value="7" style="color: red">IT</option>
                                    <option value="8" style="color: red">?</option>
                                    <option value="9" style="color: red">INT</option>
                                    <option value="10">T</option>
                                    <option value="11">STOOM</option>
                                    <option value="12">MW</option>
                                    <option value="13">KRUIS</option>
                                    <option value="14">ORIENT</option>
                                    <option value="15" style="color: red">DIENST</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="textA" class="col-md-4 col-form-label text-md-right">{{ __('Text Boven') }}</label>
                            <div class="col-md-6">
                                <input id="textA" name="first_text" class="basic-inputstyle" type="text" maxlength="14" spellcheck="false" autocapitalize="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="textB" class="col-md-4 col-form-label text-md-right">{{ __('Text Onder') }}</label>
                            <div class="col-md-6">
                                <input id="textB" name="second_text" class="basic-inputstyle" type="text" maxlength="14" spellcheck="false" autocapitalize="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Tijd') }}</label>
                            <div class="col-md-6">
                                <input required id="time" name="time" class="basic-inputstyle" type="datetime-local">
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" formaction="{{ action('SplitflapController@preview') }}">
                                    {{ __('Voorbeeld') }}
                                </button>
                                <button type="submit" class="btn btn-primary" formaction="{{ action('SplitflapController@store') }}">
                                    {{ __('Verzenden') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>          
</div>
@endsection

<style>
    .btn-primary {
        margin: 0 15px;
    }

    .preview-char {
        height: 2vw;
        font-size: 1.2vw;
    }

    .radio-container {
        display: flex;
        width: 100%;
        box-sizing: border-box;
    }

    .radio-container > * {
        flex: 1;
    }

    /* styling for a radio-type input */
    input[type=radio] {
        display:none; 
        margin:10px;
    }

    input[type=radio] + label {
        display:inline-block;
        margin:-2px;
        padding: 4px 12px;
        background-color: #e7e7e7;
        border-color: #ddd;
        transition: all .2s ease-in-out;
    }

    input[type=radio]:checked + label { 
        background-image: none;
        background-color: lightgreen;
    }

    input[type=radio] + label:hover {
        background-color: rgb(182, 238, 182);
    }

    input[type=text] {
        width: 100%;
        box-sizing: border-box;
    }

    input[type=datetime-local]{
        width: 100%;
        box-sizing: border-box;
    }

    select {
        width: 100%;
        font-size: 2em;
        padding: 4px;
        padding-bottom: 6px;
    }

    select > option {
        font-weight: bold;
    }

    @media only screen and (max-width: 767px){
        .preview-char {
            height: 5vw;
            font-size: 2.8vw;
        }
    }
</style>
