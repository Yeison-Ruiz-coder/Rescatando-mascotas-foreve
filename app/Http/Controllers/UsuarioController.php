<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Administrador;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('administrador')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $administradores = Administrador::all();
        return view('usuarios.create', compact('administradores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_1' => 'required|string|max:255',
            'Apellido_1' => 'required|string|max:255',
            'Fecha_nacimiento' => 'required|date|unique:usuarios',
            'Email' => 'required|email|unique:usuarios',
            'Password_user' => 'required|string|min:6',
            'tipo' => 'required|in:Administrador,Rescatista,Voluntario,Cliente'
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function show($id)
    {
        $usuario = Usuario::with([
            'administrador', 
            'comentarios', 
            'solicitudes', 
            'suscripciones',
            'adopciones',
            'donaciones'
        ])->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $administradores = Administrador::all();
        return view('usuarios.edit', compact('usuario', 'administradores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_1' => 'required|string|max:255',
            'Apellido_1' => 'required|string|max:255',
            'Email' => 'required|email|unique:usuarios,email,' . $id,
            'tipo' => 'required|in:Administrador,Rescatista,Voluntario,Cliente'
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    public function porTipo($tipo)
    {
        $usuarios = Usuario::where('tipo', $tipo)->get();
        return view('usuarios.por-tipo', compact('usuarios', 'tipo'));
    }
}