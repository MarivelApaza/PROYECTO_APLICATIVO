@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Tipo de Artículo</h1>

    <!-- Mostrar alertas de sesión -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de edición -->
    <form action="{{ route('tipoarticulos.update', $tipoArticulos->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $tipoArticulos->descripcion) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>

</div>
@endsection
