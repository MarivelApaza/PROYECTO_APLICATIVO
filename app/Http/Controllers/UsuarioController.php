<?php

namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = User::all();

        // Retornar la vista con los usuarios
        return view('usuarios.index', compact('usuarios'));
    }
}
