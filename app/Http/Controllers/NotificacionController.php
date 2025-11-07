<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Usuario;
use App\Models\Administrador;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::with(['usuario', 'administrador'])->get();
        return view('notificaciones.index', compact('notificaciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $administradores = Administrador::all();
        return view('notificaciones.create', compact('usuarios', 'administradores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Contenido' => 'required|string',
            'Fecha_envio' => 'required|date',
            'usuario_id' => 'nullable|exists:usuarios,id',
            'administrador_id' => 'nullable|exists:administradores,id'
        ]);

        Notificacion::create($request->all());

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación creada exitosamente.');
    }

    public function show($id)
    {
        $notificacion = Notificacion::with(['usuario', 'administrador'])->findOrFail($id);
        return view('notificaciones.show', compact('notificacion'));
    }

    public function edit($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $usuarios = Usuario::all();
        $administradores = Administrador::all();
        return view('notificaciones.edit', compact('notificacion', 'usuarios', 'administradores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Contenido' => 'required|string',
            'Fecha_envio' => 'required|date',
            'usuario_id' => 'nullable|exists:usuarios,id',
            'administrador_id' => 'nullable|exists:administradores,id'
        ]);

        $notificacion = Notificacion::findOrFail($id);
        $notificacion->update($request->all());

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->delete();

        return redirect()->route('notificaciones.index')
            ->with('success', 'Notificación eliminada exitosamente.');
    }
}