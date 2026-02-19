<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        $comentarios = Comentario::with('usuario')->get();
        return view('admin.comentarios.index', compact('comentarios'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('admin.comentarios.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Contenido' => 'required|string',
            'Fecha' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        Comentario::create($request->all());

        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentario creado exitosamente.');
    }

    public function show($id)
    {
        $comentario = Comentario::with('usuario')->findOrFail($id);
        return view('admin.comentarios.show', compact('comentario'));
    }

    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);
        $usuarios = Usuario::all();
        return view('admin.comentarios.edit', compact('comentario', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Contenido' => 'required|string',
            'Fecha' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id'
        ]);

        $comentario = Comentario::findOrFail($id);
        $comentario->update($request->all());

        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $comentario->delete();

        return redirect()->route('admin.comentarios.index')
            ->with('success', 'Comentario eliminado exitosamente.');
    }
}
