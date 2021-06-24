@extends('layouts.app')

@section('title', 'Registreren')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <form method="POST" id="register-form" action="{{ route('register') }}">
                @csrf
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="name"><strong>Vooraam</strong></label>
                                <input id="name" type="text" value="{{ old('first_name') }}" class="form-control" name="first_name" required autocomplete="given-name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="lastname"><strong>Familienaam</strong></label>
                                <input id="lastname" type="text" value="{{ old('last_name') }}" class="form-control" name="last_name" required autocomplete="family-name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="birth_day"><strong>Geboortedatum</strong></label>
                                <input id="birth_day" type="date" value="{{ old('birth_day') }}" class="form-control" name="birth_day" required autocomplete="bday">
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="birth_place"><strong>Geboorteplaats</strong></label>
                                <input id="birth_place" type="text" value="{{ old('birth_place') }}" class="form-control" name="birth_place" required autocomplete="birth-place">
                                @error('birth_place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="address"><strong>Adres</strong></label>
                                <input id="address" type="text" value="{{ old('address') }}" class="form-control" name="address" required autocomplete="street-address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="residence"><strong>Woonplaats</strong></label>
                                <input id="residence" type="text" value="{{ old('residence') }}" class="form-control" name="residence" required autocomplete="address-level2">
                                @error('residence')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="postal_code"><strong>Postcode</strong></label>
                                <input id="postal_code" type="text" value="{{ old('postal_code') }}" class="form-control" name="postal_code" required autocomplete="postal-code">
                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="province"><strong>Provincie</strong></label>
                                <input id="province" type="text" value="{{ old('province') }}" class="form-control" name="province" required autocomplete="address-level1">
                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="country"><strong>Land</strong></label>
                                <input id="country" type="text" value="{{ old('country') }}" class="form-control" name="country" required autocomplete="country">
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="mobile_phone"><strong>GSM nummer</strong></label>
                                <input id="mobile_phone" type="tel" value="{{ old('mobile_phone') }}" class="form-control" name="mobile_phone" required autocomplete="tel">
                                @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="phone"><strong>Vast Nummer</strong></label>
                                <input id="phone" type="tel" value="{{ old('phone') }}" class="form-control" name="phone" autocomplete="tel">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="name_parent"><strong>Naam ouder</strong></label>
                                <input id="name_parent" type="text" value="{{ old('name_parent') }}" class="form-control" name="name_parent">
                                @error('name_parent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="username"><strong>Gebruikersnaam</strong></label>
                                <input id="username" type="text" value="{{ old('username') }}" class="form-control" name="username" autocomplete="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="email"><strong>Email adres</strong></label>
                                <input id="email" type="email" value="{{ old('email') }}" class="form-control" name="email" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="password"><strong>Wachtwoord</strong></label>
                                <input id="password" type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-lg-6">
                                <label for="password-confirm"><strong>Wachtwoord herhalen</strong></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" onclick="return confirmation('register-form')" class="btn btn-primary">
                                    Registreren
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
