@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Consultas de Clientes</h1>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('clientes.consultaCliente') }}" method="GET">
        <div class="mb-3">
            <label for="termino" class="form-label">Buscar Cliente</label>
            <input type="text" class="form-control" id="termino" name="termino" value="{{ request()->input('termino') }}">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Resultados de la búsqueda -->
    @if($clientes->isEmpty())
        <p>No se encontraron resultados.</p>
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo Documento</th>
                    <th>Número Documento</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre }} {{ $cliente->apellidos }}</td>
                        <td>{{ $cliente->tipo_documento }}</td>
                        <td>{{ $cliente->num_documento }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->ciudad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
