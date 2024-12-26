<?php

namespace App\Http\Controllers;

use App\Models\Articulos;
use App\Models\TipoArticulos; // Para la relación con tipo_articulos
use App\Models\Proveedores; // Para la relación con proveedores
use Illuminate\Http\Request;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = Articulos::all();

        // Pasa la variable $articulos a la vista
        return view('articulos.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoArticulos = TipoArticulos::all();

    // Obtener todos los proveedores
        $proveedores = Proveedores::all();

    // Pasar las variables a la vista
    return view('articulos.create', compact('tipoArticulos', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|max:30',
            'precio_venta' => 'required|numeric',
            'precio_costo' => 'required|numeric',
            'stock' => 'required|integer',
            'cod_tipo_articulo' => 'required|exists:tipo_articulos,id',
            'cod_proveedor' => 'required|exists:proveedor,id',
            'fecha_ingreso' => 'required|date',
        ]);

        // Crear el artículo
        Articulos::create([
            'descripcion' => $request->descripcion,
            'precio_venta' => $request->precio_venta,
            'precio_costo' => $request->precio_costo,
            'stock' => $request->stock,
            'cod_tipo_articulo' => $request->cod_tipo_articulo,
            'cod_proveedor' => $request->cod_proveedor,
            'fecha_ingreso' => $request->fecha_ingreso,
        ]);

        return redirect()->route('articulos.index')->with('success', 'Artículo creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulos $articulos)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulos $articulos)
    {
        $tipos = TipoArticulos::all();
        $proveedores = Proveedores::all();
        return view('articulos.edit', compact('articulo', 'tipos', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articulos $articulos)
    {
        $request->validate([
            'descripcion' => 'required|max:30',
            'precio_venta' => 'required|numeric',
            'precio_costo' => 'required|numeric',
            'stock' => 'required|integer',
            'cod_tipo_articulo' => 'required|exists:tipo_articulos,id',
            'cod_proveedor' => 'required|exists:proveedor,id',
            'fecha_ingreso' => 'required|date',
        ]);

        // Actualizar el artículo
        $articulo->update([
            'descripcion' => $request->descripcion,
            'precio_venta' => $request->precio_venta,
            'precio_costo' => $request->precio_costo,
            'stock' => $request->stock,
            'cod_tipo_articulo' => $request->cod_tipo_articulo,
            'cod_proveedor' => $request->cod_proveedor,
            'fecha_ingreso' => $request->fecha_ingreso,
        ]);

        return redirect()->route('articulos.index')->with('success', 'Artículo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulos $articulos)
    {
        $articulo->delete();

        return redirect()->route('articulos.index')->with('success', 'Artículo eliminado con éxito');
    }
}
