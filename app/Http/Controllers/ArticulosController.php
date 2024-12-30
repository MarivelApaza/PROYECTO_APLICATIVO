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
        $articulos = Articulos::with(['proveedor', 'tipoArticulo'])->get(); // Cargar las relaciones

    return view('articulos.index', compact('articulos'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipoArticulos = TipoArticulos::all();
        $proveedores = Proveedores::all();
    return view('articulos.create', compact('tipoArticulos', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar los campos
    $request->validate([
        'descripcion' => 'required|max:30',
        'precio_venta' => 'required|numeric',
        'precio_costo' => 'required|numeric',
        'stock' => 'required|integer',
        'cod_tipo_articulo' => 'required|exists:tipoarticulos,id', // Aquí el nombre debe ser 'cod_tipo_articulo'
        'cod_proveedor' => 'required|exists:proveedores,id',
        'fecha_ingreso' => 'required|date',
    ]);

    // Crear el artículo
    Articulos::create([
        'descripcion' => $request->descripcion,
        'precio_venta' => $request->precio_venta,
        'precio_costo' => $request->precio_costo,
        'stock' => $request->stock,
        'cod_tipo_articulo' => $request->cod_tipo_articulo, // Aquí el nombre debe ser 'cod_tipo_articulo'
        'cod_proveedor' => $request->cod_proveedor,
        'fecha_ingreso' => $request->fecha_ingreso,
    ]);

    // Redirigir al listado de artículos con un mensaje de éxito
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
        return view('articulos.edit', compact('articulos', 'tipos', 'proveedores'));  // Cambia 'articulos' a 'articulo'
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
        'cod_tipo_articulo' => 'required|exists:tipoarticulos,id', // Asegúrate que el nombre sea 'cod_tipo_articulo'
        'cod_proveedor' => 'required|exists:proveedores,id',
        'fecha_ingreso' => 'required|date',
    ]);

    // Actualizar el artículo
    $articulos->update([
        'descripcion' => $request->descripcion,
        'precio_venta' => $request->precio_venta,
        'precio_costo' => $request->precio_costo,
        'stock' => $request->stock,
        'cod_tipo_articulo' => $request->cod_tipo_articulo, // Asegúrate que el nombre sea 'cod_tipo_articulo'
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
        $articulos->delete();

        return redirect()->route('articulos.index')->with('success', 'Artículo eliminado con éxito');
    }

    public function consultaArticulo(Request $request)
{
    // Obtener el término de búsqueda
    $termino = $request->input('termino');

    // Realizar la consulta de artículos según el término de búsqueda
    $articulos = Articulos::where('descripcion', 'like', "%$termino%")
                         ->orWhere('precio_venta', 'like', "%$termino%")
                         ->orWhere('precio_costo', 'like', "%$termino%")
                         ->orWhere('stock', 'like', "%$termino%")
                         ->orWhereHas('proveedor', function($query) use ($termino) {
                             $query->where('proveedor', 'like', "%$termino%");  // Asegúrate de que 'nombre' sea la columna correcta en 'proveedores'
                         })
                         ->get();

    // Retornar la vista 'consultaarticulo' con los resultados
    return view('articulos.consultaarticulos', compact('articulos'));
}


}
