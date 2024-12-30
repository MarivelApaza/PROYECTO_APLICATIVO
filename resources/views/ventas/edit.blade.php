@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Venta</h2>

    <form action="{{ route('ventas.update', $venta->id) }}" method="POST" id="formVenta">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">Selecciona un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Venta</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $venta->fecha }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente" {{ $venta->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="completado" {{ $venta->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                <option value="cancelado" {{ $venta->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>

        <div class="mb-3">
            <h4>Artículos</h4>
            <table class="table" id="productosTable">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->productos as $index => $producto)
                    <tr class="productoItem">
                        <td>
                            <select name="articulos[{{ $index }}][producto_id]" class="form-control" required>
                                <option value="">Selecciona un producto</option>
                                @foreach($productos as $prod)
                                    <option value="{{ $prod->id }}" data-precio="{{ $prod->precio_venta }}" 
                                        {{ $producto->id == $prod->id ? 'selected' : '' }}>
                                        {{ $prod->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="articulos[{{ $index }}][cantidad]" class="form-control cantidad" min="1" value="{{ $producto->pivot->cantidad }}" required>
                        </td>
                        <td>
                            <input type="text" name="articulos[{{ $index }}][precio_total]" class="form-control precio_total" value="{{ number_format($producto->pivot->precio_total, 2) }}" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm eliminarProducto">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-primary mt-2" id="agregarProducto">Agregar Producto</button>
        </div>

        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="text" id="subtotal" class="form-control" name="subtotal" value="{{ number_format($venta->subtotal, 2) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="igv" class="form-label">IGV (18%)</label>
            <input type="text" id="igv" class="form-control" name="igv" value="{{ number_format($venta->igv, 2) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" id="total" class="form-control" name="total" value="{{ number_format($venta->total, 2) }}" readonly>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Venta</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let productosTable = document.getElementById("productosTable").getElementsByTagName('tbody')[0];
        let agregarProductoButton = document.getElementById("agregarProducto");

        // Calcular totales
        let total = 0;
        let subtotal = 0;
        let igv = 0;

        // Agregar producto
        agregarProductoButton.addEventListener("click", function() {
            let productoCount = productosTable.getElementsByClassName("productoItem").length;
            let nuevoProductoRow = productosTable.insertRow();

            // Crear celdas para la nueva fila
            let celdaProducto = nuevoProductoRow.insertCell(0);
            let celdaCantidad = nuevoProductoRow.insertCell(1);
            let celdaTotal = nuevoProductoRow.insertCell(2);
            let celdaAcciones = nuevoProductoRow.insertCell(3);

            // Agregar contenido a las celdas
            celdaProducto.innerHTML = `
                <select name="articulos[${productoCount}][producto_id]" class="form-control" required>
                    <option value="">Selecciona un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_venta }}">
                            {{ $producto->descripcion }}
                        </option>
                    @endforeach
                </select>
            `;
            celdaCantidad.innerHTML = `
                <input type="number" name="articulos[${productoCount}][cantidad]" class="form-control cantidad" min="1" value="1" required>
            `;
            celdaTotal.innerHTML = `
                <input type="text" name="articulos[${productoCount}][precio_total]" class="form-control precio_total" readonly>
            `;
            celdaAcciones.innerHTML = `
                <button type="button" class="btn btn-danger btn-sm eliminarProducto">Eliminar</button>
            `;

            // Agregar el evento de eliminar al nuevo botón
            let botonEliminar = nuevoProductoRow.querySelector('.eliminarProducto');
            botonEliminar.addEventListener("click", function() {
                eliminarProducto(this);
            });

            // Actualizar el total y el subtotal de la venta
            actualizarTotales();
        });

        // Eliminar producto
        function eliminarProducto(boton) {
            let row = boton.closest("tr");
            row.remove();
            actualizarTotales();
        }

        // Actualizar el total, subtotal y IGV
        function actualizarTotales() {
            total = 0;
            subtotal = 0;
            igv = 0;

            let precioTotales = document.querySelectorAll('.precio_total');
            let cantidades = document.querySelectorAll('.cantidad');
            let productos = document.querySelectorAll('select[name^="articulos"]');

            productos.forEach((producto, index) => {
                let precio = parseFloat(producto.selectedOptions[0].getAttribute('data-precio') || 0);
                let cantidad = parseInt(cantidades[index].value || 0);
                let precioTotal = precio * cantidad;
                precioTotales[index].value = precioTotal.toFixed(2);
                subtotal += precioTotal;
            });

            // Calcular IGV (18%)
            igv = subtotal * 0.18;

            // Calcular Total
            total = subtotal + igv;

            // Mostrar los valores en los campos
            document.getElementById('subtotal').value = subtotal.toFixed(2);
            document.getElementById('igv').value = igv.toFixed(2);
            document.getElementById('total').value = total.toFixed(2);
        }

        // Actualizar los totales cuando cambie la cantidad o el producto
        document.addEventListener('change', function(event) {
            if (event.target.classList.contains('cantidad') || event.target.matches('select[name^="articulos"]')) {
                actualizarTotales();
            }
        });
    });
</script>

@endsection
