@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Consulta de Artículos</h2>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('articulos.consultaArticulo') }}" method="GET">
            <div class="mb-3">
                <label for="termino" class="form-label">Buscar por descripción, precio de venta, precio de costo o proveedor</label>
                <input type="text" name="termino" id="termino" class="form-control" value="{{ request('termino') }}">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Mostrar resultados -->
        @if(isset($articulos) && count($articulos) > 0)
            <h3>Resultados:</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Precio de Venta</th>
                        <th>Precio de Costo</th>
                        <th>Stock</th>
                        <th>Proveedor</th>
                        <th>Fecha de Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo)
                        <tr>
                            <td>{{ $articulo->descripcion }}</td>
                            <td>{{ $articulo->precio_venta }}</td>
                            <td>{{ $articulo->precio_costo }}</td>
                            <td>{{ $articulo->stock }}</td>
                            <td>{{ $articulo->proveedor->nombre ?? 'N/A' }}</td>
                            <td>{{ $articulo->fecha_ingreso }}</td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No se encontraron resultados.</p>
        @endif
    </div>
@endsection
