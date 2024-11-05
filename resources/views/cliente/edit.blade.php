@extends('layouts.base')
@section('titulo','Sistema Gestion Ventas | Clientes')
@section('mostrarResumen', false)
@section('contenido')
<br><br>
<div class="container-fluid px-4">
    <div class="card mb-4" style="background-color: #d0ecf1;"> 
        <div class="card-header" style="background-color: #cfbadf;">
            <h2 class="mt-4">Editar Cliente</h2>
        </div>
        <div class="card-body"> 
            <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $cliente->nombres }}" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $cliente->apellidos }}" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}" required>
                </div>

                <button type="submit" class="btn btn-success" style="background-color: #a73a63; border: 2px solid #a73a63;">Actualizar Cliente</button>
                <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
