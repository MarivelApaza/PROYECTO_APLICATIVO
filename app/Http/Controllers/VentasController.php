<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\Cliente;
use App\Models\Articulos;
use App\Models\DetalleVentas;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Ventas::with('cliente')->get();  
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes
        $productos = Articulos::all(); // Obtener todos los productos

        return view('ventas.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio' => 'required|numeric',
        ]);

        // Crear la venta
        $venta = Ventas::create([
            'cliente_id' => $request->cliente_id,
            'proveedor_id' => auth()->user()->id, // Aquí usamos el usuario autenticado como proveedor
            'tipo_articulo_id' => 1, // Este valor debe ser asignado de acuerdo a tu lógica
            'total' => $request->total,
        ]);

        // Guardar los detalles de la venta
        foreach ($request->productos as $producto) {
            DetalleVentas::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto['producto_id'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'precio_total' => $producto['cantidad'] * $producto['precio'],
            ]);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito.');
    
    
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
    public function edit(Ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventas $ventas)
    {
        //
    }
}
