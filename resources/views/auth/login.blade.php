@extends('layouts.app')
@section('content')
<style>
    /* Fondo de pantalla completo */
    body {
        background: linear-gradient(135deg, #ebdef0, #ecf0f1);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Estilo del formulario */
    .login-card {
        width: 100%;
        max-width: 600px; /* Aumentar el tamaño máximo a 600px */
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        margin-top: 50px; /* Añadir un margen superior para moverlo hacia abajo */
    }

    .login-header {
        background: #965282;
        color: white;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        padding: 20px;
    }

    .login-body {
        background: #f7f9fc;
        padding: 30px;
    }

    .form-control {
        border-radius: 10px;
        height: 45px; /* Aumentar la altura de los inputs */
        font-size: 16px; /* Aumentar el tamaño de la fuente */
    }

    .btn-primary {
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 1rem;
        background-color: #965282;
    }
</style>



<!-- Formulario de Login -->
<div class="container-fluid d-flex justify-content-center align-items-center" style="width: 100%;">
    <div class="card login-card" >
        <div class="card-header login-header">
            {{ __('Login') }}
        </div>
        <div class="card-body login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
