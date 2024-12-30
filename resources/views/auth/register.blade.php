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
        align-items: center; /* Centrado vertical y horizontal */
    }

    /* Estilo del formulario */
    .login-card {
        width: 100%; /* Ajustar el formulario para que ocupe el 100% del contenedor */
        max-width: 600px; /* Ajustar el tamaño máximo del formulario */
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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

<!-- Contenedor principal para centrar el formulario -->
<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card login-card">
        <div class="card-header login-header">{{ __('Registrarse') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="roles_id" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                    <div class="col-md-6">
                        <select id="roles_id" class="form-control @error('roles_id') is-invalid @enderror" name="roles_id" required>
                            @foreach (\App\Models\Roles::all() as $role) 
                                <option value="{{ $role->id }}" {{ old('roles_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->nombre }} <!-- Verifica que el nombre de la columna en la base de datos sea 'nombre' -->
                                </option>
                            @endforeach
                        </select>

                        @error('roles_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
