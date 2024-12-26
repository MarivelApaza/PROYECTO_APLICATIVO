@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Nueva Venta</h2>

        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Datos del Cliente -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente_id">Cliente</label>
                        <select name="cliente_id" id="cliente_id" class="form-control" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" id="total" class="form-control" required readonly>
                    </div>
                </div>
            </div>

            <!-- Productos -->
            <h4 class="text-center">Productos</h4>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="productos-body">
                    <tr>
                        <td>
                            <input type="number" name="productos[0][producto_id]" class="form-control producto_id" required>
                        </td>
                        <td>
                            <select name="productos[0][producto_id]" class="form-control producto_select" required>
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_venta }}">{{ $producto->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="productos[0][cantidad]" class="form-control cantidad" min="1" required>
                        </td>
                        <td>
                            <input type="number" name="productos[0][precio]" class="form-control precio" readonly>
                        </td>
                        <td>
                            <input type="number" name="productos[0][precio_total]" class="form-control precio_total" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-product">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-info" id="add-product">Añadir producto</button>

            <button type="submit" class="btn btn-primary mt-3">Generar Venta</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update price and total when product is selected or quantity is changed
            function updatePriceAndTotal(row) {
                const precio = row.querySelector('.precio');
                const cantidad = row.querySelector('.cantidad').value;
                const precioTotal = row.querySelector('.precio_total');
                
                const productSelect = row.querySelector('.producto_select');
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const productPrice = selectedOption.getAttribute('data-precio');
                
                if (productPrice && cantidad > 0) {
                    precio.value = productPrice;
                    precioTotal.value = (productPrice * cantidad).toFixed(2);
                }
            }

            // Event listener to calculate total when product is selected
            document.querySelector('#productos-body').addEventListener('change', function(e) {
                if (e.target.classList.contains('producto_select') || e.target.classList.contains('cantidad')) {
                    updatePriceAndTotal(e.target.closest('tr'));
                }
            });

            // Add new product row
            document.getElementById('add-product').addEventListener('click', function() {
                const newRow = document.querySelector('#productos-body tr').cloneNode(true);
                const rowCount = document.querySelectorAll('#productos-body tr').length;
                
                // Reset values for new row
                newRow.querySelectorAll('input').forEach(input => input.value = '');
                newRow.querySelectorAll('.producto_select').forEach(select => select.selectedIndex = 0);
                newRow.querySelector('.precio').value = '';
                newRow.querySelector('.precio_total').value = '';
                newRow.querySelector('.remove-product').style.display = 'inline-block';
                
                document.querySelector('#productos-body').appendChild(newRow);
            });

            // Remove product row
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-product')) {
                    e.target.closest('tr').remove();
                    // Recalculate the total after row removal
                    calculateTotal();
                }
            });

            // Calculate the total of the sale
            function calculateTotal() {
                let total = 0;
                document.querySelectorAll('.precio_total').forEach(function(input) {
                    total += parseFloat(input.value) || 0;
                });
                document.getElementById('total').value = total.toFixed(2);
            }
        });
    </script>
@endsection
