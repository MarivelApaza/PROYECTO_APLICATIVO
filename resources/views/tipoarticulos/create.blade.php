@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nuevo Tipo de Artículo</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para crear un nuevo tipo de artículo -->
    <form action="{{ route('tipoarticulos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
        </div>
<br><br>
        <button type="submit" class="btn btn-primary">Guardar Tipo de Artículo</button>
    </form>
</div>
@endsection
