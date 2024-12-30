<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes
        return view('clientes.index', compact('clientes')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'tipo_documento' => 'required|string|max:20', // Validar tipo de documento
            'num_documento' => 'required|string|max:20',   // Validar número de documento
        ]);
    
        // Crear el nuevo cliente
        $cliente = new Cliente();
        $cliente->nombre = $request->input('nombre');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->ciudad = $request->input('ciudad');
        $cliente->tipo_documento = $request->input('tipo_documento'); // Asignar tipo de documento
        $cliente->num_documento = $request->input('num_documento');   // Asignar número de documento
    
        // Guardar el cliente en la base de datos
        $cliente->save();
    
        // Redirigir a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        // Lógica para mostrar detalles del cliente (si es necesario)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'tipo_documento' => 'required|string|max:20', // Validar tipo de documento
            'num_documento' => 'required|string|max:20',   // Validar número de documento
        ]);
    
        // Actualizar los datos del cliente
        $cliente->nombre = $request->input('nombre');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->ciudad = $request->input('ciudad');
        $cliente->tipo_documento = $request->input('tipo_documento'); // Actualizar tipo de documento
        $cliente->num_documento = $request->input('num_documento');   // Actualizar número de documento
    
        // Guardar los cambios
        $cliente->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete(); // Eliminar el cliente

        // Redirigir a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }


  
        public function consultaCliente(Request $request)
    {
        // Obtener el término de búsqueda desde el input
        $termino = $request->input('termino');

        // Realizar la consulta de clientes según el término de búsqueda
        $clientes = Cliente::where('nombre', 'like', "%$termino%")
                           ->orWhere('apellidos', 'like', "%$termino%")
                           ->orWhere('tipo_documento', 'like', "%$termino%")
                           ->orWhere('num_documento', 'like', "%$termino%")
                           ->orWhere('telefono', 'like', "%$termino%")
                           ->orWhere('ciudad', 'like', "%$termino%")
                           ->get();

        // Retornar la vista 'consultacliente' y pasar los datos encontrados
        return view('clientes.consultacliente', compact('clientes'));
    }
}
