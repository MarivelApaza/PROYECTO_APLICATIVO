<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedores::all();

        // Retornar la vista con los proveedores
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proveedor' => 'required|max:100',
            'contacto' => 'required|max:100',
            'telefono' => 'required|max:15',
            'direccion' => 'required|max:100',
        ]);

        // Crear un nuevo proveedor
        Proveedores::create([
            'proveedor' => $request->proveedor,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedores $proveedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedores $proveedores)
    {
        return view('proveedores.edit', compact('proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedores $proveedores)
    {
        $request->validate([
            'proveedor' => 'required|max:100',
            'contacto' => 'required|max:100',
            'telefono' => 'required|max:15',
            'direccion' => 'required|max:100',
        ]);

        // Actualizar los datos del proveedor
        $proveedores->update([
            'proveedor' => $request->proveedor,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedores $proveedores)
    {
        $proveedores->delete();

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}
