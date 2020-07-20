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
                                    <input type="radio" id="radio1" name="board" value="A" @if(($board ?? 'A') == 'A') checked="checked" @endif>
                                    <label for="radio1">Bord A</label>
                                    <input type="radio" id="radio2" name="board" value="B" @if(($board ?? 'A') == 'B') checked="checked" @endif>
                                    <label for="radio2">Bord B</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="align" class="col-md-4 col-form-label text-md-right">{{ __('Uitlijnen') }}</label>
                            <div class="col-md-6">
                                <div id="align" class="radio-container text-align">
                                    <input type="radio" name="align" id="left" value="left" @if(($align ?? 'left') == 'left') checked="checked" @endif>
                                    <label for="left">links</label>
                                    <input type="radio" name="align" id="center" value="center" @if(($align ?? 'left') == 'center') checked="checked" @endif>
                                    <label for="center">center</label>
                                    <input type="radio" name="align" id="right" value="right" @if(($align ?? 'left') == 'right') checked="checked" @endif>
                                    <label for="right">rechts</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icoon') }}</label>
                            <div class="col-md-6">
                                <select name="icon_index" class="basic-inputstyle">
                                    <option value="0" @if(($icon_index ?? '') == 0) selected="selected" @endif>[blank]</option>
                                    <option value="1" @if(($icon_index ?? '') == 1) selected="selected" @endif>IC</option>
                                    <option value="2" @if(($icon_index ?? '') == 2) selected="selected" @endif>IR</option>
                                    <option value="3" @if(($icon_index ?? '') == 3) selected="selected" @endif>L</option>
                                    <option value="4" @if(($icon_index ?? '') == 4) selected="selected" @endif>P</option>
                                    <option value="5" @if(($icon_index ?? '') == 5) selected="selected" @endif>EXP</option>
                                    <option value="6" @if(($icon_index ?? '') == 6) selected="selected" @endif style="color: red">IR</option>
                                    <option value="7" @if(($icon_index ?? '') == 7) selected="selected" @endif style="color: red">IT</option>
                                    <option value="8" @if(($icon_index ?? '') == 8) selected="selected" @endif style="color: red">?</option>
                                    <option value="9" @if(($icon_index ?? '') == 9) selected="selected" @endif style="color: red">INT</option>
                                    <option value="10" @if(($icon_index ?? '') == 10) selected="selected" @endif>T</option>
                                    <option value="11" @if(($icon_index ?? '') == 11) selected="selected" @endif>STOOM</option>
                                    <option value="12" @if(($icon_index ?? '') == 12) selected="selected" @endif>MW</option>
                                    <option value="13" @if(($icon_index ?? '') == 13) selected="selected" @endif>KRUIS</option>
                                    <option value="14" @if(($icon_index ?? '') == 14) selected="selected" @endif>ORIENT</option>
                                    <option value="15" @if(($icon_index ?? '') == 15) selected="selected" @endif style="color: red">DIENST</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="textA" class="col-md-4 col-form-label text-md-right">{{ __('Text Boven') }}</label>
                            <div class="col-md-6">
                            <input id="textA" name="first_text" class="basic-inputstyle" type="text" maxlength="14" spellcheck="false" autocapitalize="off" value="{{$first_text ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="textB" class="col-md-4 col-form-label text-md-right">{{ __('Text Onder') }}</label>
                            <div class="col-md-6">
                                <input id="textB" name="second_text" class="basic-inputstyle" type="text" maxlength="14" spellcheck="false" autocapitalize="off" value="{{$second_text ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Tijd') }}</label>
                            <div class="col-md-6">
                                <input  required id="time" name="time" class="basic-inputstyle" type="datetime-local" value="{{$time ?? ''}}">
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
                                <button type="submit" id="prev-btn" class="btn basic-inputstyle" formaction="{{ action('SplitflapController@preview') }}">
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

    #prev-btn:hover {
        background-color: lightgreen;
    }

    .btn {
        margin: 15px 15px 0px 15px;
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
