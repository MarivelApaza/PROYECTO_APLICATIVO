@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Venta</h2>

    <form action="{{ route('ventas.store') }}" method="POST" id="formVenta">
        @csrf
        
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">Selecciona un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora de Venta</label>
            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
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
                <tr class="productoItem">
            <td>
                <select name="detalle_ventas[0][producto_id]" class="form-control" required>
                    <option value="">Selecciona un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_venta }}">
                            {{ $producto->descripcion }}
                        </option>
                    @endforeach
                </select>
            </td>
                        <td>
                            <input type="number" name="detalle_ventas[0][cantidad]" class="form-control cantidad" min="1" value="1" required>
                        </td>
                        <td>
                            <input type="text" name="detalle_ventas[0][precio_total]" class="form-control precio_total" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm eliminarProducto">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary mt-2" id="agregarProducto">Agregar Producto</button>
        </div>

        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="text" id="subtotal" class="form-control" name="subtotal" readonly>
        </div>

        <div class="mb-3">
            <label for="igv" class="form-label">IGV (18%)</label>
            <input type="text" id="igv" class="form-control" name="igv" readonly>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" id="total" class="form-control" name="total" readonly>
        </div>

        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                <option value="">Selecciona un proveedor</option>
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_articulo_id" class="form-label">Tipo de Artículo</label>
            <select name="tipo_articulo_id" id="tipo_articulo_id" class="form-control" required>
                <option value="">Selecciona un tipo de artículo</option>
                @foreach($tipoArticulos as $tipoArticulo)
                    <option value="{{ $tipoArticulo->id }}">{{ $tipoArticulo->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Venta</button>
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
                <select name="detalle_ventas[${productoCount}][producto_id]" class="form-control" required>
                    <option value="">Selecciona un producto</option>
                    @foreach($articulos as $articulo)
                        <option value="{{ $articulo->id }}" data-precio="{{ $articulo->precio_venta }}">
                            {{ $articulo->descripcion }}
                        </option>
                    @endforeach
                </select>
            `;
            celdaCantidad.innerHTML = `
                <input type="number" name="detalle_ventas[${productoCount}][cantidad]" class="form-control cantidad" min="1" value="1" required>
            `;
            celdaTotal.innerHTML = `
                <input type="text" name="detalle_ventas[${productoCount}][precio_total]" class="form-control precio_total" readonly>
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
            let productos = document.querySelectorAll('select[name^="detalle_ventas"]');

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
            if (event.target.classList.contains('cantidad') || event.target.matches('select[name^="detalle_ventas"]')) {
                actualizarTotales();
            }
        });
    });
</script>

@endsection
