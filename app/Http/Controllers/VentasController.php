<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\Cliente;
use App\Models\Articulos;
use App\Models\Proveedores;
use App\Models\DetalleVentas;
use App\Models\TipoArticulos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Ventas::with(['cliente', 'proveedor', 'tipoArticulo'])->get();
    return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Articulos::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'articulos' => 'required|array',
            'articulos.*.producto_id' => 'required|exists:articulos,id',
            'articulos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Iniciar la transacción
        DB::beginTransaction();

        try {
            // Crear la venta
            $venta = Ventas::create([
                'cliente_id' => $request->cliente_id,
                'proveedor_id' => 1, // Asumimos un proveedor por defecto
                'tipo_articulo_id' => 1, // Tipo de artículo por defecto, o lo puedes pasar por el formulario
                'fecha_hora' => $request->fecha,
                'total' => 0, // Lo actualizamos más tarde
                'estado' => 'pendiente', // Puedes cambiar este estado según corresponda
            ]);

            $subtotal = 0;

            // Crear los detalles de la venta
            foreach ($request->articulos as $articulo) {
                $producto = Articulos::find($articulo['producto_id']);
                $precio = $producto->precio_venta;
                $cantidad = $articulo['cantidad'];
                $precio_total = $precio * $cantidad;

                // Crear el detalle de la venta
                DetalleVentas::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $articulo['producto_id'],
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'precio_total' => $precio_total,
                ]);

                $subtotal += $precio_total;
            }

            // Calcular el IGV (18%)
            $igv = $subtotal * 0.18;
            $total = $subtotal + $igv;

            // Actualizar el total de la venta
            $venta->update([
                'total' => $total,
            ]);

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta generada con éxito');
        } catch (\Exception $e) {
            // Si ocurre un error, revertimos la transacción
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al generar la venta');
        }
        
    }        

    /**
     * Display the specified resource.
     */
    public function show(Ventas $ventas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Recupera la venta y las relaciones necesarias
    $venta = Ventas::with(['cliente', 'proveedor', 'tipoArticulo', 'articulos'])->findOrFail($id);
    $venta->fecha_hora = \Carbon\Carbon::parse($venta->fecha_hora);

    // Calcular el subtotal
    $subtotal = 0;
    foreach ($venta->articulos as $articulo) {
        $subtotal += $articulo->precio_venta * $articulo->cantidad;  // Multiplicar precio de venta por cantidad
    }

    // Calcular el IGV (18%)
    $igv = $subtotal * 0.18;

    // Calcular el total
    $total = $subtotal + $igv;

    // Cargar los productos para los dropdowns
    $productos = Articulos::all(); // Obtén todos los productos disponibles

    // Cargar los datos adicionales como los clientes, proveedores y tipo de artículos
    $clientes = Cliente::all(); // Todos los clientes
    $proveedores = Proveedores::all(); // Todos los proveedores
    $tipoArticulos = TipoArticulos::all(); // Todos los tipos de artículos

    // Pasar los datos a la vista
    return view('ventas.edit', compact('venta', 'subtotal', 'igv', 'total', 'clientes', 'proveedores', 'tipoArticulos', 'productos'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Encuentra la venta a actualizar
    $venta = Ventas::with(['articulos'])->findOrFail($id);

    // Actualiza la venta (otros campos como fecha, cliente, proveedor, etc.)
    $venta->fecha_hora = \Carbon\Carbon::parse($request->input('fecha_hora'));
    $venta->cliente_id = $request->input('cliente_id');
    $venta->proveedor_id = $request->input('proveedor_id');
    $venta->tipo_articulo_id = $request->input('tipo_articulo_id');
    // Añadir cualquier otro campo necesario para actualizar

    // Guardar la venta
    $venta->save();

    // Actualizar los productos asociados a la venta
    foreach ($request->input('articulos') as $index => $articuloData) {
        $articulo = $venta->articulos[$index];  // Obtener el articulo correspondiente

        $articulo->producto_id = $articuloData['producto_id'];
        $articulo->cantidad = $articuloData['cantidad'];
        $articulo->total = $articuloData['cantidad'] * $articulo->producto->precio_venta;  // Calcular el total

        // Guardar los cambios del articulo
        $articulo->save();
    }

    // Volver a calcular el subtotal, IGV, y total
    $subtotal = 0;
    foreach ($venta->articulos as $articulo) {
        $subtotal += $articulo->total;
    }

    $igv = $subtotal * 0.18;
    $total = $subtotal + $igv;

    // Pasar los datos a la vista
    return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Buscar la venta por ID
    $venta = Ventas::findOrFail($id);

    // Eliminar la venta
    $venta->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
}
}
