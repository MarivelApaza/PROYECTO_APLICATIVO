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
use Barryvdh\DomPDF\Facade\Pdf;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Ventas::with(['cliente', 'productos.tipoArticulo'])->get();
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
    // Validar los datos del formulario
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'articulos' => 'required|array',
        'articulos.*.producto_id' => 'required|exists:articulos,id',
        'articulos.*.cantidad' => 'required|integer|min:1',
    ]);

    // Tomar el tipo_articulo_id del primer producto seleccionado (si todos tienen el mismo tipo)
    $primerProducto = Articulos::find($request->articulos[0]['producto_id']);
    $tipo_articulo_id = $primerProducto->cod_tipo_articulo; // Suponiendo que 'cod_tipo_articulo' es el campo adecuado

    // Crear la venta
    $venta = Ventas::create([
        'cliente_id' => $request->cliente_id,
        'tipo_articulo_id' => $tipo_articulo_id, // Ahora lo obtienes dinámicamente
        'fecha_hora' => now(),
        'total' => 0,  // Se calculará más tarde
        'estado' => 'pendiente', // O el estado que corresponda
    ]);

    // Inicializamos el subtotal de la venta
    $subtotal = 0;

    // Crear los detalles de la venta y calcular el total
    foreach ($request->articulos as $articulo) {
        $producto = Articulos::find($articulo['producto_id']);
        $precio = $producto->precio_venta;
        $cantidad = $articulo['cantidad'];
        $precio_total = $precio * $cantidad;

        // Agregar el producto a la venta
        $venta->productos()->attach($producto, [
            'cantidad' => $cantidad,
            'precio' => $precio,
            'precio_total' => $precio_total,
        ]);

        // Acumulamos el subtotal
        $subtotal += $precio_total;
    }

    // Calcular el IGV (si aplica)
    $igv = $subtotal * 0.18;  // Ejemplo con un 18% de IGV
    $total = $subtotal + $igv;

    // Actualizar el total en la venta
    $venta->update(['total' => $total]);

    // Redirigir o devolver respuesta
    return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
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
        // Recuperar la venta con sus relaciones necesarias
        $venta = Ventas::with(['cliente', 'tipoArticulo', 'productos'])->findOrFail($id);
        $venta->fecha_hora = \Carbon\Carbon::parse($venta->fecha_hora);
    
        // Calcular el subtotal
        $subtotal = 0;
        foreach ($venta->productos as $producto) {
            $subtotal += $producto->pivot->precio * $producto->pivot->cantidad;
        }
    
        // Calcular el IGV (18%)
        $igv = $subtotal * 0.18;
    
        // Calcular el total
        $total = $subtotal + $igv;
    
        // Cargar los productos, clientes y tipo de artículos
        $productos = Articulos::all(); 
        $clientes = Cliente::all();
        $proveedores = Proveedores::all(); 
        $tipoArticulos = TipoArticulos::all(); 
    
        // Pasar los datos a la vista
        return view('ventas.edit', compact('venta', 'subtotal', 'igv', 'total', 'clientes', 'proveedores', 'tipoArticulos', 'productos'));
    }
    
    public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'articulos' => 'required|array',
        'articulos.*.producto_id' => 'required|exists:articulos,id',
        'articulos.*.cantidad' => 'required|integer|min:1',
    ]);

    // Buscar la venta a actualizar
    $venta = Ventas::findOrFail($id);

    // Tomar el tipo_articulo_id del primer producto seleccionado (si todos tienen el mismo tipo)
    $primerProducto = Articulos::find($request->articulos[0]['producto_id']);
    $tipo_articulo_id = $primerProducto->cod_tipo_articulo;

    // Actualizar la venta
    $venta->update([
        'cliente_id' => $request->cliente_id,
        'tipo_articulo_id' => $tipo_articulo_id, // Ahora lo obtienes dinámicamente
        'fecha_hora' => now(), // Si se requiere una actualización de fecha
        'total' => 0,  // El total se actualizará más tarde
        'estado' => $request->estado, // Si deseas actualizar el estado
    ]);

    // Inicializamos el subtotal de la venta
    $subtotal = 0;

    // Eliminar los detalles de la venta previos y agregar los nuevos
    $venta->productos()->detach();  // Eliminar los productos previos relacionados a la venta

    // Crear los detalles de la venta y calcular el total
    foreach ($request->articulos as $articulo) {
        $producto = Articulos::find($articulo['producto_id']);
        $precio = $producto->precio_venta;
        $cantidad = $articulo['cantidad'];
        $precio_total = $precio * $cantidad;

        // Agregar el producto a la venta
        $venta->productos()->attach($producto, [
            'cantidad' => $cantidad,
            'precio' => $precio,
            'precio_total' => $precio_total,
        ]);

        // Acumulamos el subtotal
        $subtotal += $precio_total;
    }

    // Calcular el IGV (si aplica)
    $igv = $subtotal * 0.18;  // Ejemplo con un 18% de IGV
    $total = $subtotal + $igv;

    // Actualizar el total en la venta
    $venta->update(['total' => $total]);

    // Redirigir al índice de ventas con un mensaje de éxito
    return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
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

public function generarPdf($id)
    {
        $venta = Ventas::with(['cliente', 'productos'])->findOrFail($id);

    // Retorna un PDF generado a partir de una vista Blade
    $pdf = Pdf::loadView('ventas.pdf', compact('venta'));

    // Descarga el archivo PDF con un nombre personalizado
    return $pdf->download('venta_'.$id.'.pdf');
    }
}
