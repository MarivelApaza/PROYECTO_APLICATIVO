<?php

namespace App\Http\Controllers;

use App\Models\TipoArticulos;
use Illuminate\Http\Request;

class TipoArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoArticulos = TipoArticulos::all();  // Recuperamos todos los registros
        return view('tipoarticulos.index', compact('tipoArticulos'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipoarticulos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        // Creación del nuevo tipo de artículo
        TipoArticulos::create([
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('tipoarticulos.index')->with('success', 'Tipo de artículo creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoArticulos $tipoArticulos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoArticulos $tipoArticulos)
    {
        return view('tipoarticulos.edit', compact('tipoArticulos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoArticulos $tipoArticulos)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        // Actualización del tipo de artículo
        $tipoArticulos->update([
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('tipoarticulos.index')->with('success', 'Tipo de artículo actualizado con éxito');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoArticulos $tipoArticulos)
    {
        // Eliminar el tipo de artículo
        $tipoArticulos->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('tipoarticulos.index')->with('success', 'Tipo de artículo eliminado con éxito');
    
    }
}
