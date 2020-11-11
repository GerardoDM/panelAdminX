@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white bg-dark">{{ __('Ingrese sus credenciales') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('usuario.login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="mail">{{ __('E-Mail') }}</label>

                            
                                <input id="mail" type="email" class="form-control @error('mail') is-invalid @enderror" name="mail" value="{{ old('mail') }}" required autocomplete="mail" autofocus>

                                @error('mail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>

                        <div class="form-group">
                            <label for="pass">{{ __('Password') }}</label>

                            
                                <input id="pass" type="password" class="form-control @error('pass') is-invalid @enderror" name="pass" required autocomplete="current-password">

                                @error('pass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>

                        <div class="form-group">
                           
                                <button type="submit" class="btn btn-primary btn-block mt-4">
                                    {{ __('Login') }}
                                </button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
