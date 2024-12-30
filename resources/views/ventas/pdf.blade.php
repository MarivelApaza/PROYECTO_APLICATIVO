<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - Venta #{{ $venta->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Factura - Venta #{{ $venta->id }}</h1>
    <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
    <p><strong>Fecha:</strong> {{ $venta->fecha_hora }}</p>
    <p><strong>Total:</strong> S/. {{ number_format($venta->total, 2) }}</p>

    <h2>Detalles de la Venta</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venta->productos as $articulo)
                <tr>
                    <td>{{ $articulo->descripcion }}</td>
                    <td>{{ $articulo->pivot->cantidad }}</td>
                    <td>S/. {{ number_format($articulo->pivot->precio, 2) }}</td>
                    <td>S/. {{ number_format($articulo->pivot->precio_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
